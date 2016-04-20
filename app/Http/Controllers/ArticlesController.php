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
    public function show(Article $article)
    {
        if($article->published_at > Carbon::now()){
            return abort(404); // of wat dan ook
        }
        $niceDate = Carbon::createFromTimeStamp(strtotime($article->published_at))->diffForHumans();

        return view('articles.view', compact('article', 'niceDate'));
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

        return redirect()->route('articles.show', [$article]);
    }

    /**
     * Return the form to edit an article
     * @param  String       $slug       The slug of the article
     * @return response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update an article and persist it to the database
     * @param  StoreArticlePostRequest $request The Form Request validating the incomming request
     * @param  String                  $slug    The slug of the article to update
     * @return response
     */
    public function update(StoreArticlePostRequest $request, Article $article)
    {
        $data = $request->all();

        $slugify = new Slugify(); // Mooi opgelost, maar je kunt je heel wat tijd besparen via deze package: https://github.com/cviebrock/eloquent-sluggable ;-)
        $data['slug'] = $slugify->slugify($request->input('title'));
        $data['published_at'] = new Carbon($request->input('published_at'));

        $article->update($data);

        return redirect()->route('articles.show', [$newSlug]);
    }

    public function destroy(Article $article)
    {

    }
}
