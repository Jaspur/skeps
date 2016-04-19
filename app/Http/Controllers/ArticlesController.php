<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use Carbon\Carbon;
use App\Http\Requests;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticlePostRequest;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show'] ]);
        Carbon::setLocale(config('app.locale'));
    }

    /**
     * Show a list of all articles
     * @return response
     */
    public function index()
    {
        $articles = Article::where('published_at', '<', Carbon::now())->orderBy('published_at', 'DESC')->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show an individual article
     * @param  String       $slug       The slug of the article
     * @return response
     */
    public function show($slug)
    {
        $article = Article::where('slug', '=', $slug)->where('published_at', '<', Carbon::now())->firstOrFail();
        $author = $article->user->toArray();
        $niceDate = Carbon::createFromTimeStamp(strtotime($article->published_at))->diffForHumans();

        return view('articles.view', compact('article', 'author', 'niceDate'));
    }

    /**
     * Return the view that contains to form to create a new article
     * @return response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a new article to the database
     * @param  StoreArticlePostRequest $request The Form Request validating the incomming request
     * @return response
     */
    public function store(StoreArticlePostRequest $request)
    {
        $slugify = new Slugify();
        $slug = $slugify->slugify($request->input('title'));
        $publishDate = new Carbon($request->input('published_at'));

        if ($request->hasFile('main_image')) {
            $extension = $request->file('main_image')->getClientOriginalExtension();
            $fileName = $slug.'.'.$extension;
            
            $path = public_path().'/img/';

            $request->file('main_image')->move($path, $fileName);
        }

        Article::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'quote' => $request->input('quote'),
            'content' => $request->input('content'),
            'author' => Auth::user()->id,
            'main_picture' => asset('/img/'.$fileName),
            'published_at' => $publishDate->toDateTimeString()
        ]);

        return redirect()->route('articles.show', [$slug]);
    }

    /**
     * Return the form to edit an article
     * @param  String       $slug       The slug of the article
     * @return response
     */
    public function edit($slug)
    {
        $article = Article::where('slug', '=', $slug)->firstOrFail();

        return view('articles.edit', compact('article'));
    }

    /**
     * Update an article and persist it to the database
     * @param  StoreArticlePostRequest $request The Form Request validating the incomming request
     * @param  String                  $slug    The slug of the article to update
     * @return response
     */
    public function update(StoreArticlePostRequest $request, $slug)
    {
        $article = Article::where('slug', '=', $slug)->firstOrFail();

        $slugify = new Slugify();
        $newSlug = $slugify->slugify($request->input('title'));
        $publishDate = new Carbon($request->input('published_at'));

        $article->title = $request->input('title');
        $article->slug = $newSlug;
        $article->quote = $request->input('quote');
        $article->content = $request->input('content');
        $article->author = Auth::user()->id;
        $article->main_picture = null;
        $article->published_at = $publishDate->toDateTimeString();
        $article->save();

        return redirect()->route('articles.show', [$newSlug]);
    }

    public function destroy($slug)
    {
        
    }
}
