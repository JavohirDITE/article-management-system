<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maqolalar ro'yxati</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Maqolalar boshqaruvi</h1>

        <?php if ($message): ?>
            <div class="alert <?= $messageType ?>">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Maqola qo'shish formasi -->
        <div class="card">
            <h2>Maqola qo'shish</h2>
            <form method="POST" action="index.php">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="add">

                <div class="form-group">
                    <label for="title">Maqola nomi</label>
                    <input type="text" id="title" name="title" required maxlength="255"
                           placeholder="Maqola nomini kiriting">
                </div>

                <div class="form-group">
                    <label for="author">Muallif</label>
                    <input type="text" id="author" name="author" required maxlength="100"
                           placeholder="Muallif ismini kiriting">
                </div>

                <button type="submit" class="btn btn-save">Saqlash</button>
            </form>
        </div>

        <!-- Qidiruv -->
        <div class="card">
            <h2>Qidiruv</h2>
            <form method="GET" action="index.php" class="search-form">
                <input type="text" name="search" placeholder="Maqola nomi bo'yicha qidirish..."
                       value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
                <button type="submit" class="btn btn-search">Qidirish</button>
                <?php if ($search): ?>
                    <a href="index.php" class="btn btn-reset">Tozalash</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Maqolalar jadvali -->
        <div class="card">
            <h2>Maqolalar ro'yxati</h2>

            <?php if (empty($articles)): ?>
                <p class="empty-text">Hech qanday maqola topilmadi.</p>
            <?php else: ?>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Maqola nomi</th>
                                <th>Muallif</th>
                                <th>Qo'shilgan sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $row): ?>
                                <tr>
                                    <td><?= (int)$row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= date('d.m.Y H:i', strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <form method="POST" action="index.php"
                                              onsubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
                                            <button type="submit" class="btn btn-delete">O'chirish</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <footer>
            &copy; <?= date('Y') ?> Maqolalar boshqaruvi
        </footer>
    </div>
</body>
</html>
