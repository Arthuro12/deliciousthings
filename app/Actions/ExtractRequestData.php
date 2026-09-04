<?php

namespace App\Actions;

use Carbon\Carbon;

class ExtractRequestData
{
    public function handle(string $description): array
    {
        $text = trim((string) preg_replace('/\s+/u', ' ', $description));

        $budget = $this->budget($text);

        return [
            'category' => $this->category($text),
            'occasion' => $this->occasion($text),
            'event_date' => $this->date($text),
            'participants' => $this->participants($text),
            'location_text' => $this->location($text),
            'budget_min' => $budget['min'],
            'budget_max' => $budget['max'],
            'style' => $this->styles($text),
        ];
    }

    private function category(string $text): ?string
    {
        return match (true) {
            preg_match('/\bhochzeitstorte(?:n)?\b/ui', $text) === 1 => 'wedding_cake',
            preg_match('/\b(?:torte|torten|kuchen|cake)\b/ui', $text) === 1 => 'cake',
            preg_match('/\b(?:gebäck|backwaren)\b/ui', $text) === 1 => 'pastry',
            preg_match('/\b(?:dessert|desserts)\b/ui', $text) === 1 => 'dessert',
            default => null,
        };
    }

    private function occasion(string $text): ?string
    {
        $lower = mb_strtolower($text);

        foreach ([
            'birthday' => ['geburtstag', 'geburtstags'],
            'wedding' => ['hochzeit', 'hochzeiten'],
            'engagement' => ['verlobung', 'verlobungs'],
            'baptism' => ['taufe', 'taufen'],
            'baby-shower' => ['baby shower', 'babyparty'],
            'anniversary' => ['jubiläum', 'hochzeitstag'],
            'graduation' => ['abschluss', 'abitur'],
            'retirement' => ['ruhestand', 'pensionierung'],
        ] as $value => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($lower, $keyword)) {
                    return $value;
                }
            }
        }

        return null;
    }

    private function participants(string $text): ?int
    {
        if (preg_match('/\b(\d{1,5})\s*(?:personen|gäste|portionen|stück|st\.?|people)\b/ui', $text, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }

    private function location(string $text): ?string
    {
        // Prefer common German phrasing and stop at punctuation/conjunctions.
        if (preg_match('/\b(?:in|nach|bei)\s+([A-ZÄÖÜ][\p{L}-]{2,}(?:\s+[A-ZÄÖÜ][\p{L}-]{2,})?)(?=\s*(?:,|\.|!|\?|\s+für\b|\s+am\b|\s+im\b|\s+mit\b|$))/u', $text, $matches)) {
            return trim($matches[1]);
        }

        return null;
    }

    private function budget(string $text): array
    {
        $empty = ['min' => null, 'max' => null];

        if (preg_match('/\b(\d{2,7}(?:[.,]\d{1,2})?)\s*(?:€|EUR|Euro)\s*(?:-|bis|–)\s*(\d{2,7}(?:[.,]\d{1,2})?)\s*(?:€|EUR|Euro)?\b/ui', $text, $matches)) {
            return [
                'min' => $this->number($matches[1]),
                'max' => $this->number($matches[2]),
            ];
        }

        if (preg_match('/\b(?:budget\s*(?:liegt\s*)?(?:bei|von)?|ca\.?|etwa|ungefähr|circa|um|bei)\s*(\d{2,7}(?:[.,]\d{1,2})?)\s*(?:€|EUR|Euro)\b/ui', $text, $matches)) {
            $value = $this->number($matches[1]);
            return ['min' => $value, 'max' => $value];
        }

        if (preg_match('/\b(\d{2,7}(?:[.,]\d{1,2})?)\s*(?:€|EUR|Euro)\b/ui', $text, $matches)) {
            $value = $this->number($matches[1]);
            return ['min' => $value, 'max' => $value];
        }

        return $empty;
    }

    private function number(string $value): float
    {
        return (float) str_replace(',', '.', $value);
    }

    private function styles(string $text): array
    {
        $lower = mb_strtolower($text);
        $styles = [
            'Elegant' => 'elegant',
            'Modern' => 'modern',
            'Minimalistisch' => 'minimalistisch',
            'Romantisch' => 'romantisch',
            'Klassisch' => 'klassisch',
            'Verspielt' => 'verspielt',
            'Rustikal' => 'rustikal',
        ];

        return array_values(array_keys(array_filter(
            $styles,
            fn (string $value) => str_contains($lower, $value),
        )));
    }

    private function date(string $text): ?string
    {
        if (preg_match('/\b(\d{1,2})[.\/-](\d{1,2})(?:[.\/-](\d{4}))?\b/', $text, $matches)) {
            $year = isset($matches[3]) ? (int) $matches[3] : (int) now()->year;

            try {
                $date = Carbon::create($year, (int) $matches[2], (int) $matches[1]);

                if (!isset($matches[3]) && $date->isPast()) {
                    $date->addYear();
                }

                return $date->format('Y-m-d');
            } catch (\Throwable) {
                return null;
            }
        }

        $months = [
            'januar' => 1, 'februar' => 2, 'märz' => 3, 'april' => 4,
            'mai' => 5, 'juni' => 6, 'juli' => 7, 'august' => 8,
            'september' => 9, 'oktober' => 10, 'november' => 11, 'dezember' => 12,
        ];

        $pattern = '/\b(\d{1,2})\.\s*(' . implode('|', array_keys($months)) . ')(?:\s+(\d{4}))?\b/ui';

        if (preg_match($pattern, $text, $matches)) {
            $year = isset($matches[3]) ? (int) $matches[3] : (int) now()->year;
            $month = $months[mb_strtolower($matches[2])];

            try {
                $date = Carbon::create($year, $month, (int) $matches[1]);

                if (!isset($matches[3]) && $date->isPast()) {
                    $date->addYear();
                }

                return $date->format('Y-m-d');
            } catch (\Throwable) {
                return null;
            }
        }

        return null;
    }
}