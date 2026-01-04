<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Clipminer' ?></title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Brand Config -->
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    brand: {
                        primary: '#6366F1',
                        bg: '#0F1220',
                        surface: '#1A1F36'
                    }
                }
            }
        }
    }
    </script>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
