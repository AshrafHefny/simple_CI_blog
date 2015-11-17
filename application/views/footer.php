
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Simple Blog 2015</p>
                </div>
            </div>
        </div>
    </footer>

<?php echo $this->js; ?>
<script>
$(document).ready(function(){
    $('#sortPostsByDate').change(function(){
        var url = $('#sortPostsByDate').val();
        location.href = '<?php echo site_url('?sortByDate=') ?>' + url;
    });
    
    $('#sortPostsByAuthor').change(function(){
        var url = $('#sortPostsByAuthor').val();
        location.href = '<?php echo site_url('?sortPostsByAuthor=') ?>' + url;
    });
    
    $('#sortPostsByCategory').change(function(){
        var url = $('#sortPostsByCategory').val();
        location.href = '<?php echo site_url('?sortPostsByCategory=') ?>' + url;
    });
});
</script> 
</body>

</html>
