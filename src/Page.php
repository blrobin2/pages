<?php

namespace BruceCms\Pages;

use Illuminate\Database\Eloquent\Model;
use Knp\Menu\MenuFactory;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Renderer\ListRenderer;

class Page extends Model
{

    /**
     * Columns which are allowed to be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'link',
        'body',
        'sort',
        'hidden'
    ];

    /**
     * Limit a query to the pages that are not hidden from navigation.
     *
     * @param $query
     * @return mixed
     */
    public function scopeUnhidden($query)
    {
        return $query->where('hidden', '0');
    }

    /**
     * Build the navigation for pages.
     */
    public function printMenu()
    {
        $factory = new MenuFactory();
        $menu = $factory->createItem('navigation');

        $pages = $this->unhidden()->orderBy('sort')->get();

        // Create the top level of navigation.
        foreach ($pages as $page) {
            if ($page->parent_id == 0) {
                $menu->addChild($page->title, [ 'uri' => url($page->link) ]);
                $menu[$page->title]->setAttribute('id', $page->id);
            }
        }

        // Create the child nodes.
        foreach ($menu as $menuItem) {
            foreach ($pages as $page) {
                if ($page->parent_id == $menuItem->getAttribute('id')) {
                    $menu[$menuItem->getName()]->addChild($page->title, ['uri' => url($page->link) ]);
                }
            }
        }

        $renderer = new ListRenderer(new Matcher());
        echo $renderer->render($menu);
    }
}
