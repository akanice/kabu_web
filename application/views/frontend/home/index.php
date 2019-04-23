<?php
    define('F_HOME', 'home/');
?>
<div class="" id="contents" class="main-page">
<?php
    $this->load->view(FRONTEND.F_HOME.'slider',$this->data);
    $this->load->view(FRONTEND.F_HOME.'categories');
    $this->load->view(FRONTEND.F_HOME.'combohot');
    $this->load->view(FRONTEND.F_HOME.'mostviewed');
?>
</div>