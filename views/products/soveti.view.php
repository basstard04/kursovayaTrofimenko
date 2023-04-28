<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <h2 class="soveti_h2">Полезные советы</h2>
    <section>
        <h4><?= $question->name ?></h4>
        <br>
        <?php foreach($soviets as $soviet): ?>
            <p class="p_question_title"><?= $soviet->question_title ?></p>
            <p class="p_answer"><?= $soviet->answer ?></p>
            <img  class="razmer_setka" src="/upload/titulnik/<?= $soviet->photo ?>" alt="<?= $soviet->photo ?>">
        <?php endforeach ?>
    </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>