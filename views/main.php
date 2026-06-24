<!DOCTYPE html>
<html lang="<?= Language::getCurrentLanguage() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= Language::get('title') ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Language Switcher -->
        <div class="language-switcher">
            <?php foreach (Language::getAvailableLanguages() as $code => $name): ?>
                <a href="?lang=<?= $code ?>" 
                   class="lang-btn <?= Language::getCurrentLanguage() === $code ? 'active' : '' ?>">
                    <?= $name ?>
                </a>
            <?php endforeach; ?>
        </div>

        <header>
            <h1><i class="fas fa-newspaper"></i> <?= Language::get('title') ?></h1>
        </header>

        <!-- Message Display -->
        <?php if ($message): ?>
            <div class="message <?= $messageType ?>">
                <i class="fas <?= $messageType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
                <?= Article::escapeOutput($message) ?>
            </div>
        <?php endif; ?>

        <!-- Add Article Form -->
        <section class="add-section">
            <h2><i class="fas fa-plus-circle"></i> <?= Language::get('add_article') ?></h2>
            <form method="POST" action="index.php" class="add-form">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="action" value="add">
                
                <div class="form-group">
                    <label for="title">
                        <i class="fas fa-heading"></i> <?= Language::get('article_name') ?>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           placeholder="<?= Language::get('article_name') ?>" 
                           required 
                           maxlength="255">
                </div>

                <div class="form-group">
                    <label for="author">
                        <i class="fas fa-user"></i> <?= Language::get('author') ?>
                    </label>
                    <input type="text" 
                           id="author" 
                           name="author" 
                           placeholder="<?= Language::get('author') ?>" 
                           required 
                           maxlength="100">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?= Language::get('save') ?>
                </button>
            </form>
        </section>

        <!-- Search Section -->
        <section class="search-section">
            <h2><i class="fas fa-search"></i> <?= Language::get('search') ?></h2>
            <form method="GET" action="index.php" class="search-form">
                <input type="text" 
                       name="search" 
                       placeholder="<?= Language::get('search_placeholder') ?>"
                       value="<?= Article::escapeOutput($search ?? '') ?>">
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-search"></i> <?= Language::get('search') ?>
                </button>
                <?php if ($search): ?>
                    <a href="index.php" class="btn btn-clear">
                        <i class="fas fa-times"></i>
                    </a>
                <?php endif; ?>
            </form>
        </section>

        <!-- Articles List -->
        <section class="list-section">
            <h2><i class="fas fa-list"></i> <?= Language::get('articles_list') ?></h2>
            
            <?php if (empty($articles)): ?>
                <div class="no-articles">
                    <i class="fas fa-inbox"></i>
                    <p><?= Language::get('no_articles') ?></p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="articles-table">
                        <thead>
                            <tr>
                                <th><?= Language::get('id') ?></th>
                                <th><?= Language::get('title_column') ?></th>
                                <th><?= Language::get('author_column') ?></th>
                                <th><?= Language::get('created_at') ?></th>
                                <th><?= Language::get('actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td><?= $article['id'] ?></td>
                                    <td><?= Article::escapeOutput($article['title']) ?></td>
                                    <td><?= Article::escapeOutput($article['author']) ?></td>
                                    <td><?= date('d.m.Y H:i', strtotime($article['created_at'])) ?></td>
                                    <td>
                                        <form method="POST" 
                                              action="index.php" 
                                              onsubmit="return confirm('<?= Language::get('confirm_delete') ?>')" 
                                              style="display: inline;">
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> <?= Language::get('delete') ?>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>

        <footer>
            <p>&copy; <?= date('Y') ?> Article Management System | Created by Javohir</p>
        </footer>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>
