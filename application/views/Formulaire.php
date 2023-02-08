<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Takalo-Takalo</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/Banner-Heading-Image-images.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/Login-Form-Basic-icons.css">
</head>

<body>
    <section class="position-relative py-5">
        <div class="d-md-none">
            <img allowfullscreen="" frameborder="0" src="<?php echo base_url(); ?>assets/images/test.jpg" width="100%" height="100%">
         </div>
        <div class="d-none d-md-block position-absolute top-0 start-0 w-100 h-100"><img allowfullscreen="" frameborder="0" 
            src="<?php echo base_url(); ?>assets/images/test.jpg" width="100%" height="100%"></img></div>
        <div class="position-relative mx-2 my-5 m-md-5">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-md-6 col-xl-5 col-xxl-4 offset-md-6 offset-xl-7 offset-xxl-8">
                        <div>
                            <form class="border rounded shadow p-3 p-md-4 p-lg-5" method="post" style="background: var(--bs-body-bg);" action="<?php echo base_url(); ?>Welcome/addobject">
                                <h3 class="text-center mb-3">Chaque formulaire est obligatoire</h3>
                                <div class="mb-3"><input class="form-control" type="text" name="nomObjet" placeholder="Nom de votre Objet"></div>
                                <div class="mb-3"><input class="form-control" type="number" step="0.1" name="prix" placeholder="Prix estimatif"></div>
                                <div class="mb-3">
                                    <select class="form-control"name="prix">
                                        <?php 
                                            foreach ($categ as $categ) { ?>
                                                <option value="<?php echo $categ->idCategorie; ?>"><?php echo $categ->nom; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="mb-3"><input class="form-control" type="file" name="userfile" size="100000" placeholder=""></div>
                                <div class="mb-3"><textarea class="form-control" name="message" placeholder="Desription" rows="6"></textarea></div>
                                <div class="mb-3"><button class="btn btn-primary" type="submit">Send </button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>