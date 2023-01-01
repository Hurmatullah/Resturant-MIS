<?php require_once "../www/header.php" ?>
                <!-- Begin section 2 -->
	<?php $test_index++; ?>
     <div class="col-sm-12">
        <a name="basic-multiple-fields"></a>
            <div class=" ">
                <input class="form-control" id="test<?php echo $test_index ?>" value="2" />
            </div>
                        
        </div> 
       <script>
            $(function () {
                $('#test<?php echo $test_index ?>').inputpicker({
                                data:[
                                    {value:"1",text:"Text 1", description: "This is the description of the text 1."},
                                    {value:"2",text:"Text 2", description: "This is the description of the text 2."},
                                    {value:"3",text:"Text 3", description: "This is the description of the text 3."}
                                ],
                                fields:[
                                    {name:'value',text:'Id'},
                                    {name:'text',text:'Title'},
                                    {name:'description',text:'Description'}
                                ],
                                autoOpen: true,
                                headShow: true,
                                fieldText : 'text',
                                fieldValue: 'value'
                            });
                        });
                    </script>

                </section>