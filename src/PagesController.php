<?php namespace BruceCms\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new PagesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'sort',
            'index',
            'create',
            'store',
            'edit',
            'update',
            'destroy'
        ]]);
    }

    /**
     * Return the home page.
     *
     * @return Response
     */
    public function home()
    {
        return view('home');
    }

	/**
	 * Display a listing of all the pages.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::all()->sortBy('sort');

        return view('pages::index', compact('pages'));
	}

    /**
     * Sort the pages by the order passed through the request.
     *
     * @param Request $request
     * @return Redirect
     */
    public function sort(Request $request)
    {
        $sortOrder = explode(',', $request->get('order'));

        for($i = 1; $i < sizeof($sortOrder); $i++) {
            $page = Page::find($sortOrder[$i]);
            $page->sort = $i;
            $page->save();
        }

        return redirect()->back();
    }

	/**
	 * Show the form for creating a new page.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pages::create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param PageRequest $request
	 * @return Response
	 */
	public function store(PageRequest $request)
	{
		Page::create($request->all());

        return redirect('pages');
	}

	/**
	 * Display the specified page.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function show($id)
	{
		$page = Page::findOrFail($id);

		return view('pages::show', compact('page'));
	}

	/**
	 * Show the form for editing the specified page.
	 *
	 * @param  string  $link
	 * @return Response
	 */
	public function edit($link)
	{
		$page = Page::where('link', $link)->firstOrFail();

		return view('pages::edit', compact('page'));
	}

	/**
	 * Update the specified page in storage.
	 *
	 * @param  string  $link
     * @param  PageRequest  $request
	 * @return Response
	 */
	public function update($link, PageRequest $request)
	{
		$page = Page::where('link', $link)->firstOrFail();

		$page->update($request->all());

        return redirect('pages');
	}

	/**
	 * Remove the specified page from storage.
	 *
	 * @param  string  $link
	 * @return Response
	 */
	public function destroy($link)
	{
		$page = Page::where('link', $link)->firstOrFail();

		$page->delete();

        return redirect('pages');
	}
}