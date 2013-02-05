<div class="widget_804">
    <h1>Add Discussion</h1>
    <div class="sos_div content-div">
        <div class="title">
            <h2>Title</h2>
        </div>
        <div class="info">
            <div class="heading plain_textarea">
                <?php
                
                    echo $form->create('Senior', array('action' => 'edit_discussion'));
                    echo $form->hidden('id', array('value' => $post['Post']['id'], 'type' => 'textarea', 'rows' => '1'));
                    echo $form->input('topic', array('class' => 'height-40', 'div' => false, 'label' => false, 'value' => $post['Post']['topic'], 'type' => 'textarea', 'rows' => '1'));
                    ?>
                </div>
            </div>
        </div>




        <div class="sos_div content-div">
            <div class="title">
                <h2>Content</h2>
            </div>
            <div class="info">
                <div class="heading plain_textarea">
                    <?php
                    echo $form->input('post', array('class' => 'height-233', 'div' => false, 'label' => false, 'value' => $post['Post']['post'], 'type' => 'textarea'));
                    ?>

                </div>
            </div>
        </div>
        <div class="gray-buttons">
            <?php
            echo $form->end(array('value' => 'create', 'class' => 'button', 'div' => false));
            ?>
            
            <input type="button" value="Reset" class="button">
        </div>



        
</div>