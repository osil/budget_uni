<?php
session_start();
session_destroy();
echo "
<meta charset='utf-8' />
<script>
window.location = 'login.php';
</script>
";
