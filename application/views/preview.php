<!DOCTYPE html>
<html>
<head>
    <title>Clips Ready</title>
    <style>
        body {
            background: #0f1220;
            color: #fff;
            font-family: system-ui;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }
        .clips {
            display: flex;
            gap: 20px;
        }
        .clip {
            background: #1a1f36;
            padding: 12px;
            border-radius: 12px;
            width: 180px;
        }
        .clip img {
            width: 100%;
            border-radius: 8px;
        }
        .cta {
            background: #1a1f36;
            padding: 30px;
            border-radius: 16px;
        }
        .btn {
            display: block;
            margin-top: 20px;
            background: linear-gradient(90deg,#6b5cff,#8a7cff);
            color: white;
            padding: 14px;
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Success! Your clips are ready!</h2>

<div class="container">

    <div>
        <div class="clips">
            <?php foreach ($previews as $clip): ?>
                <div class="clip">
                    <img src="<?= $clip['thumbnail'] ?>" alt="">
                    <p><?= $clip['title'] ?></p>
                    <small><?= $clip['duration'] ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="cta">
        <h3>Let AI do the work</h3>
        <ul>
            <li>Turn videos into short viral clips</li>
            <li>Automatic captions</li>
            <li>Easy editing</li>
            <li>Share to TikTok & Shorts</li>
        </ul>

        <a href="/login" class="btn">Continue →</a>
        <p style="opacity:.7;margin-top:10px">
            Sign up to download your clips. It only takes a minute.
        </p>
    </div>

</div>

</body>
</html>
