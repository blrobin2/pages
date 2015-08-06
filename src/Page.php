<?php namespace BruceCms\Pages;

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

        foreach ($this->unhidden()->orderBy('sort')->get() as $page) {
            $menu->addChild($page->title, [ 'uri' => '/'.$page->link ]);
        }

        $renderer = new ListRenderer(new Matcher());
        echo $renderer->render($menu);
    }
}
