<div class="inwave_metabox">
    <?php
    $this->select('background_color_page',
        'Background Color Page',
        array(''=>'Default', '#ffffff' => 'White', '#000000' => 'Black', '#00c8d6' => 'Blue', '#49a32b' => 'Green', '#ec3642' => 'Red', '#efc10a' => 'Yellow', '#ed9914' => 'Orange', '#f9f9f9' => 'Very Light Gray'),
        ''
    );
    ?>
    <?php
    $this->select('slider',
        'Select Revolution  Slider',
        $this->getRevoSlider()
    );
    ?>
   <?php
    $this->select('show_pageheading',
        'Show page heading',
        array(''=>'Default', 'yes' => 'Yes', 'no' => 'No'),
        ''
    );
    ?>
    <?php
    $this->upload('pageheading_bg','Page heading background');
    ?>
    <?php
    $this->upload('logo','Change logo');
    ?>
    <?php
    $this->select('sidebar_position',
        'Sidebar Position',
        array('' => 'Default','none' => 'Without Sidebar', 'right' => 'Right', 'left' => 'Left', 'bottom' => 'Bottom'),
        ''
    );
    ?>
    <?php
    $this->select('sidebar_name',
        'Sidebar Name',
        $this->getSideBars(),
        ''
    );
    ?>
    <?php
    $this->text('page_class', 'Extra class', $desc = 'Add extra class for page content', $default = '');
    ?>
    <?php
    $this->select('header_option',
        'Header style',
        array('' => 'Default', 'default' => 'Header Style 1','v2' => 'Header Style 2', 'v3' => 'Header Style 3','v4' => 'Header Style 4','v5' => 'Header Style 5'),
        ''
    );
    ?>
	<?php
    $this->select('header_sticky',
        'Sticky Header',
        array(''=>'Default', 'yes' => 'Yes', 'no' => 'No'),
        ''
    );
    ?>
    <?php
    $this->select('primary_menu',
        'Primary Menu',
        $this->getMenuList(),
        ''
    );
    ?>
	<?php
    $this->select('show_donate_button',
        'Show Donate button',
        array('' => 'Default','yes' => 'Yes', 'no' => 'No'),
        ''
    );
    ?>
    <?php
    $this->select('footer_option',
        'Footer style',
        array('' => 'Default',  'default' => 'Footer v1', 'v2' => 'Footer v2'),
        ''
    );
    ?>
</div>