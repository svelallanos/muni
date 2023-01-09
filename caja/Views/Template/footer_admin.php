<footer class="footer-admin mt-auto footer-light">
  <div class="container-xl px-4">
    <div class="row">
      <div class="col-md-6 small">Copyright &copy; Tu Sitio Web 2022</div>
      <div class="col-md-6 text-md-end small">
        <a href="#!">Política de privacidad</a>
        &middot;
        <a href="#!">Términos &amp; condiciones</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>

<?php printHTMLRequired() ?>

<script type="text/javascript">
  var base_url = '<?= base_url() ?>';
</script>

<script src="<?= media() ?>/js/general/sweetalert2@11.js?version=<?= getVerion() ?>"></script>
<script src="<?= media() ?>/js/general/all.js?version=<?= getVerion() ?>"></script>
<script src="<?= media() ?>/js/general/jquery-3.6.0.min.js?version=<?= getVerion() ?>"></script>
<script src="<?= media() ?>/js/general/jquery.dataTables.min.js?version=<?= getVerion() ?>"></script>
<script src="<?= media() ?>/js/general/feather.min.js?version=<?= getVerion() ?>"></script>
<script src="<?= media() ?>/js/general/bootstrap.bundle.min.js?version=<?= getVerion() ?>"></script>
<script src="<?= media() ?>/js/general/scripts.js?version=<?= getVerion() ?>"></script>
<script src="<?= media() ?>/js/general/axios.min.js?version=<?= getVerion() ?>"></script>

<script src="<?= media() ?>/js/general/filerequired.js?version=<?= getVerion() ?>"></script>

<?php if (isset($data['page_function_js']) && !empty($data['page_function_js'])) { ?>
  <script src="<?= media() ?>/js/<?= $data['page_function_js'] ?>.js?version=<?= getVerion() ?>"></script>
<?php } ?>
</body>

</html>