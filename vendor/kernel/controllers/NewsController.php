<?php
 class NewsController
 {
   public function __construct()
   {
     if (App::admin() == false)
       Redirect::url('/admin');
     if (!in_array('news_ctrl',App::admin('permissions')))
      Redirect::url('/admin');
   }

   public function index($curPage)
   {
       $count = 10;
       $start = $count * ($curPage -1);
       $news = App::database('news_items')->orderBy("published")->getPage($start, $count);
       $numPages = ceil(App::database('news_items')->count() / $count);

       App::view('news/index', compact('news', 'curPage', 'numPages'));
   }

   public function create()
   {
     App::view('news/create');
   }

   public function store()
   {
     $request = Request::all();
     $validator = new Validator($request, [
       'title' => 'required',
       'published' => 'required|date:mdy',
       'brief' => 'required|min:60|max:200',
       'body' => 'required|min:200'
     ]);

     if ($validator->fails())
        Redirect::back([
          'input_data' => $request,
          'errors' => $validator->errors
        ]);

     $uploads = $this->upload_files($request);

     $news_item = new News();
     $news_item->define([
       'title' => $request['title'],
       'published' => formatDate($request['published'], 'Y-m-d'),
       'brief' => nl2br($request['brief']),
       'body' => nl2br($request['body']),
       'picture' => $uploads['picture'],
       'link' => $uploads['link']
     ]);

     App::database('news_items')->insert($news_item);
     Redirect::url("/admin/news/all/page=1");
   }

   public function upload_files($request)
   {
     $link_ext = 'null';
     $link_name = 'void';
     if (isset($_FILES['link']) && $_FILES['link']['size'] != 0) {
       $link_ext = pathinfo($_FILES['link']['name'], PATHINFO_EXTENSION);
       $link_name = str_replace(' ', '_', $request['title']);
       if (!upload_file($_FILES['link'], "../distr/releases/$link_name.$link_ext"))
          Redirect::back([
            'input_data' => $request,
            'errors' => ["Sorry, there was an error uploading your file."]
          ]);
     }

     $pic_ext = 'null';
     $pic_name = 'void';
     if (isset($_FILES['picture']) && $_FILES['picture']['size'] != 0) {
       $pic_ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
       $pic_name = str_replace(' ', '_', $request['title']);
       if (!upload_img($_FILES['picture'], "../assets/image/news/$pic_name.$pic_ext"))
          Redirect::back([
            'input_data' => $request,
            'errors' => ["Sorry, there was an error uploading your picture. Resolution must be below 800 by 800 pixels"]
          ]);
     }

     return [
       'picture' => "$pic_name.$pic_ext",
       'link' => "$link_name.$link_ext"
     ];
   }

   public function edit($id)
   {
     $news = App::database('news_items')->where('id', '=', $id)[0];
     App::view('news/update', compact('news'));
   }

   public function update()
   {
     $request = Request::all();
     $validator = new Validator($request, [
       'title' => 'required',
       'published' => 'required|date:mdy',
       'brief' => 'required|min:60|max:200',
       'body' => 'required|min:200'
     ]);

     if ($validator->fails())
       Redirect::back([
         'input_data' => $request,
         'errors' => $validator->errors
       ]);

     $uploads = $this->upload_files($request);

     if ($uploads['link'] == 'void.null' || $uploads['picture'] == 'void.null' )
        $old_news = App::database('news_items')->where('id', '=', $request['id'])[0];

     if ($uploads['link'] == 'void.null') $uploads['link'] = $old_news->link;
     if ($uploads['picture'] == 'void.null') $uploads['picture'] = $old_news->picture;

     $news_item = new News();
     $news_item->define([
       'title' => $request['title'],
       'published' => formatDate($request['published'], 'Y-m-d'),
       'brief' => nl2br($request['brief']),
       'body' => nl2br($request['body']),
       'picture' => $uploads['picture'],
       'link' => $uploads['link']
     ]);

     $news_item->id = $request['id'];

     App::database('news_items')->update($news_item);
     Redirect::url("/admin/news/all/page=1");
   }

   public function destroy()
   {
     $item = App::database('news_items')->where('id', '=', Request::input('id'))[0];
     if ($item->link != 'void.null')
       unlink('../distr/releases/' . $item->link);
     if ($item->picture != 'void.null')
       unlink('../assets/image/news/' . $item->picture);
     App::database('news_items')->destroy(Request::input('id'));
     Redirect::url("/admin/news/all/page=1");
   }

 }
