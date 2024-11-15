<?php

/**
 * BAZAR_Taxonomy class.
 *
 * Built Custom Taxonomies.
 *
 * @package  Odin
 * @category Taxonomy
 * @author   WPBrasil
 * @version  2.1.4
 */
class BAZAR_Taxonomy
{

    /**
     * Array of labels for the Taxonomy.
     *
     * @var array
     */
    protected $labels = array();

    /**
     * Taxonomy arguments.
     *
     * @var array
     */
    protected $arguments = array();

    /**
     * Construct Taxonomy.
     *
     * @param string $name        The singular name of the taxonomy.
     * @param string $slug        Taxonomy slug.
     * @param string $object_type Name of the object type for the taxonomy object.
     */
    public function __construct($name, $slug, $object_type)
    {
        $this->name        = $name;
        $this->slug        = $slug;
        $this->object_type = $object_type;

        // Register Taxonomy.
        add_action('init', array(&$this, 'register_taxonomy'));
    }

    /**
     * Set custom labels.
     *
     * @param array $labels Custom labels.
     */
    public function set_labels($labels = array())
    {
        $this->labels = $labels;
    }

    /**
     * Set custom arguments.
     *
     * @param array $arguments Custom arguments.
     */
    public function set_arguments($arguments = array())
    {
        $this->arguments = $arguments;
    }

    /**
     * Define Taxonomy labels.
     *
     * @return array Taxonomy labels.
     */
    protected function labels()
    {
        $default = array(
            'name'                       => sprintf(__('%ss', 'bazar'), $this->name),
            'singular_name'              => sprintf(__('%s', 'bazar'), $this->name),
            'add_or_remove_items'        => sprintf(__('Add or Remove %ss', 'bazar'), $this->name),
            'view_item'                  => sprintf(__('View %s', 'bazar'), $this->name),
            'edit_item'                  => sprintf(__('Edit %s', 'bazar'), $this->name),
            'search_items'               => sprintf(__('Search %s', 'bazar'), $this->name),
            'update_item'                => sprintf(__('Update %s', 'bazar'), $this->name),
            'parent_item'                => sprintf(__('Parent %s:', 'bazar'), $this->name),
            'parent_item_colon'          => sprintf(__('Parent %s:', 'bazar'), $this->name),
            'menu_name'                  => sprintf(__('%ss', 'bazar'), $this->name),
            'add_new_item'               => sprintf(__('Add New %s', 'bazar'), $this->name),
            'new_item_name'              => sprintf(__('New %s', 'bazar'), $this->name),
            'all_items'                  => sprintf(__('All %ss', 'bazar'), $this->name),
            'separate_items_with_commas' => sprintf(__('Separate %ss with comma', 'bazar'), $this->name),
            'choose_from_most_used'      => sprintf(__('Choose from %ss most used', 'bazar'), $this->name)
        );

        return array_merge($default, $this->labels);
    }

    /**
     * Define Taxonomy arguments.
     *
     * @return array Taxonomy arguments.
     */
    protected function arguments()
    {
        $default = array(
            'labels'            => $this->labels(),
            'hierarchical'      => true, // Like categories.
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
        );

        return array_merge($default, $this->arguments);
    }

    /**
     * Register Taxonomy.
     */
    public function register_taxonomy()
    {
        register_taxonomy($this->slug, $this->object_type, $this->arguments());
    }
}