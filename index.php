<?php

    /* Coded By https://github.com/msfpt */

    function template_render(String $template_file, Array $data, int $status = 200){
        
        $template_page = file_get_contents($template_file);
    
        foreach (array_keys($data) as $key => $search) {

            $replace = $data[$search];

            $template_page = str_replace($search, $replace, $template_page);

        }

        http_response_code($status);

        echo $template_page;

    }

    if(!empty($_FILES['file'])){

        $file_name = $_FILES['file']['name'];

        $file_type = $_FILES['file']['type'];

        $file_tmp = $_FILES['file']['tmp_name'];

        template_render('template.html', array(
            '{{ is_show }}' => '',
            '{{ file_name }}' => $file_name,
            '{{ base64_url }}' => "data:$file_type;base64,".base64_encode(file_get_contents($file_tmp))
        ), 200);

    } else {

        template_render('template.html', array('{{ is_show }}' => 'hide'), 200);

    }

?>