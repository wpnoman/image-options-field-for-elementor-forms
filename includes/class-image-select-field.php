<?php
class Elementor_Hello_World_Widget_1 extends \Elementor\Widget_Base
{
    // register_hello_world_widget
    public function get_name(): string
    {
        return 'hello_world_widget_1';
    }

    public function get_title(): string
    {
        return esc_html__('Hello World 1', 'elementor-addon');
    }

    public function get_icon(): string
    {
        return 'eicon-code';
    }

    public function get_categories(): array
    {
        return ['basic'];
    }

    public function get_keywords(): array
    {
        return ['hello', 'world'];
    }

    protected function render(): void
    {
?>
        <p> Hello World </p>
    <?php
    }

    protected function content_template(): void
    {
    ?>
        <p> Hello World </p>
<?php
    }
}
