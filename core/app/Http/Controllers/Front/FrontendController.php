<?php
namespace App\Http\Controllers\Front;
use Illuminate\{
    Http\Request,
    Support\Facades\Session
};

use App\{
  Models\Item,
  Models\Setting,
  Models\Subscriber,
  Helpers\EmailHelper,
  Http\Controllers\Controller,
  Http\Requests\ReviewRequest,
  Http\Requests\SubscribeRequest,
  Repositories\Front\FrontRepository,
  Repositories\Front\ApplyCouponRepository
};
use App\Helpers\SmsHelper;
use App\Models\Brand;
use App\Models\CampaignItem;
use App\Models\Category;
use App\Models\ChieldCategory;
use App\Models\Fcategory;
use App\Models\HomeCutomize;
use App\Models\Order;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Language;
use App\Models\Post;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\TrackOrder;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Validator;
use App\Helpers\PriceHelper;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Catalog;
use App\Models\Coupons;
use App\Models\Tax;
use App\Models\TempCart;
use App\Models\User;
use App\Models\ApplyCoupon;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Carbon\Carbon;
// use Illuminate\Support\Facades\File;
// use File;
use function GuzzleHttp\json_decode;
use PHPMailer\PHPMailer\{
  PHPMailer,
  SMTP,
  Exception
};

// require 'vendor/autoload.php';


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require '../vendor/phpmailer/phpmailer/src/SMTP.php';

class FrontendController extends Controller{
  public function __construct(FrontRepository $repository, ApplyCouponRepository $applycoupon){
    $this->repository = $repository;
    $setting = Setting::first();
    if($setting->recaptcha == 1){
      Config::set('captcha.sitekey', $setting->google_recaptcha_site_key);
      Config::set('captcha.secret', $setting->google_recaptcha_secret_key);
    }
    $this->middleware('localize');
    $this->applycoupon = $applycoupon;
  }

  // ------------------ HOME ------------------
	public function index(){
    $setting = Setting::first();
    $home_customize = HomeCutomize::first();

    // feature category
    $feature_category_ids = json_decode($home_customize->feature_category,true);
    $feature_category_title = $feature_category_ids['feature_title'];
    $feature_category = [];
    for($i=1;$i<=4;$i++){
      if(!in_array($feature_category_ids['category_id'.$i],$feature_category)){
        if($feature_category_ids['category_id'.$i]){
          $feature_category[] = $feature_category_ids['category_id'.$i];
        }
      }
    }

    $feature_categories = [];
    foreach($feature_category as $key => $cat){
      $feature_categories[] = Category::findOrFail($cat);
    }
    $feature_category_items = [];
    if(count($feature_categories)){
      $index = '';
      foreach($feature_categories as $key => $data){
        if($data->id == $feature_category_ids['category_id1']){
          $index = $key;
        }
      }

      $category = $feature_categories[$index]->id;
      $subcategory = $feature_category_ids['subcategory_id1'];
      $childcategory = $feature_category_ids['childcategory_id1'];

      $feature_category_items = Item::when($category, function ($query, $category){
      return $query->where('category_id', $category);
      })
      ->when($subcategory, function ($query, $subcategory){
      return $query->where('subcategory_id', $subcategory);
      })
      ->when($childcategory, function ($query, $childcategory){
      return $query->where('childcategory_id', $childcategory);
      })
      ->whereStatus(1)->take(10)->orderby('id','desc')->get();
    }

    // feature category end
    $home_customize = HomeCutomize::first();
    // popular category

    $popular_category_ids = json_decode($home_customize->popular_category,true);
    $popular_category_title = $popular_category_ids['popular_title'];

    $popular_category = [];
    for($i=1;$i<=4;$i++){
      if(!in_array($popular_category_ids['category_id'.$i],$popular_category)){
        if($popular_category_ids['category_id'.$i]){
          $popular_category[] = $popular_category_ids['category_id'.$i];
        }
      }
    }
    $popular_categories = [];
    foreach($popular_category as $key => $cat){
      $popular_categories[] = Category::findOrFail($cat);
    }

    $popular_category_items = [];

    if(count($popular_categories) > 0){
      $index = '';
      foreach($popular_categories as $key => $data){
        if($data->id == $popular_category_ids['category_id1']){
          $index = $key;
        }
      }
      $pupular_cateogry_home4 = null;
      if($setting->theme == 'theme4'){
        $pupular_cateogries_home4 = json_decode($home_customize->home_4_popular_category,true);
        $pupular_cateogry_home4 = [];
        foreach($pupular_cateogries_home4 as $home4category){
          $pupular_cateogry_home4[] = Category::with('items')->findOrFail($home4category);
        }
      }

      // dd($pupular_cateogry_home4);
      $category = $popular_categories[$index]->id;
      $subcategory = $popular_category_ids['subcategory_id1'];
      $childcategory = $popular_category_ids['childcategory_id1'];

      $popular_category_items = Item::when($category, function ($query, $category){
        return $query->where('category_id', $category);
        })
        ->when($subcategory, function ($query, $subcategory){
        return $query->where('subcategory_id', $subcategory);
        })
        ->when($childcategory, function ($query, $childcategory){
        return $query->where('childcategory_id', $childcategory);
        })
        ->whereStatus(1)->get();
    }

    // two column category
    $two_column_category_ids = json_decode($home_customize->two_column_category,true);

    $two_column_category = [];
    for($i=1;$i<=3;$i++){
      if(isset($two_column_category_ids['category_id'.$i]) && !in_array($two_column_category_ids['category_id'.$i],$two_column_category)){
        if($two_column_category_ids['category_id'.$i]){
          $two_column_category[] = $two_column_category_ids['category_id'.$i];
        }
      }
    }

    $two_column_categories = Category::whereStatus(1)->whereIn('id',$two_column_category)->orderby('id','desc')->get();

    $two_column_category_items1 = [];
    if($two_column_category_ids['category_id1']){
      $two_column_category_items1 = Item::where('category_id',$two_column_category_ids['category_id1'])->orderby('id','desc')->whereStatus(1)->take(10)->get();
    }
    if($two_column_category_ids['subcategory_id1']){
      $two_column_category_items1 = Item::where('subcategory_id',$two_column_category_ids['subcategory_id1'])->whereStatus(1)->where('category_id',$two_column_category_ids['category_id1'])->orderby('id','desc')->take(10)->get();
    }
    if($two_column_category_ids['childcategory_id1']){
      $two_column_category_items1 = Item::where('childcategory_id',$two_column_category_ids['childcategory_id1'])->whereStatus(1)->where('category_id',$two_column_category_ids['category_id1'])->orderby('id','desc')->take(10)->get();
    }

    $two_column_category_items2 = [];
    if($two_column_category_ids['category_id2']){
      $two_column_category_items2 = Item::where('category_id',$two_column_category_ids['category_id2'])->orderby('id','desc')->whereStatus(1)->take(10)->get();
    }
    if($two_column_category_ids['subcategory_id2']){
      $two_column_category_items2 = Item::where('subcategory_id',$two_column_category_ids['subcategory_id2'])->whereStatus(1)->where('category_id',$two_column_category_ids['category_id2'])->orderby('id','desc')->take(10)->get();
    }
    if($two_column_category_ids['childcategory_id2']){
      $two_column_category_items2 = Item::where('childcategory_id',$two_column_category_ids['childcategory_id2'])->whereStatus(1)->where('category_id',$two_column_category_ids['category_id2'])->orderby('id','desc')->take(10)->get();
    }

    $two_column_category_items3 = [];
    if(isset($two_column_category_ids['category_id3'])){
      if($two_column_category_ids['category_id3']){
        $two_column_category_items3 = Item::where('category_id',$two_column_category_ids['category_id3'])->orderby('id','desc')->whereStatus(1)->take(10)->get();
      }
      if($two_column_category_ids['subcategory_id3']){
        $two_column_category_items3 = Item::where('subcategory_id',$two_column_category_ids['subcategory_id3'])->whereStatus(1)->where('category_id',$two_column_category_ids['category_id3'])->orderby('id','desc')->take(10)->get();
      }
      if($two_column_category_ids['childcategory_id3']){
        $two_column_category_items3 = Item::where('childcategory_id',$two_column_category_ids['childcategory_id3'])->whereStatus(1)->where('category_id',$two_column_category_ids['category_id3'])->orderby('id','desc')->take(10)->get();
      }
    }

    $two_column_categoriess = [];
    foreach($two_column_categories as $key => $two_category){
      if($key ==0){
        $two_column_categoriess[$key] ['name'] = $two_category;
        $two_column_categoriess[$key] ['items'] = $two_column_category_items1;
      }elseif($key==1){
        $two_column_categoriess[$key] ['name'] = $two_category;
        $two_column_categoriess[$key] ['items'] = $two_column_category_items2;
      }else{
        $two_column_categoriess[$key] ['name'] = $two_category;
        $two_column_categoriess[$key] ['items'] = $two_column_category_items3;
      }
    }

    if($setting->theme == 'theme1'){
      $sliders = Slider::where('home_page','theme1')->get();
    }elseif($setting->theme == 'theme2'){
      $sliders = Slider::where('home_page','theme2')->get();
    }elseif($setting->theme == 'theme3'){
      $sliders = Slider::where('home_page','theme3')->get();
    }else{
      $sliders = Slider::where('home_page','theme4')->get();
    }

    // $brandAll = Brand::whereStatus(1)->whereIsPopular(1)->take(30)->get()->toArray();
    // foreach($brandAll as $brandf){
    //   $routePhoto = asset('assets/images/');
    //   $routePhotoFinal = $routePhoto . "/". $brandf['photo'];
    //   // echo $brandf['photo']."<br>";
    //   // echo $routePhotoFinal."<br>";
    //   if(File::exists($routePhotoFinal)){
    //     echo "Si existe <br>";
    //   }
    // }
    // echo "<pre>";
    // print_r($brandAll);
    // echo "</pre>";
    // exit();

    return view('front.index',[
      'hero_banner'   => $home_customize->hero_banner != '[]' ? json_decode($home_customize->hero_banner,true) : null,
      'banner_first'   => json_decode($home_customize->banner_first,true),
      'sliders'  => $sliders,
      'campaign_items' => CampaignItem::with('item')->whereStatus(1)->whereIsFeature(1)->orderby('id','desc')->get(),
      'services' => Service::orderby('id','desc')->get(),
      'posts'    => Post::with('category')->orderby('id','desc')->take(8)->get(),
      // 'brands'   => Brand::whereStatus(1)->get(),
      'banner_secend'  => json_decode($home_customize->banner_secend,true),
      'banner_third'   => json_decode($home_customize->banner_third,true),
      'brands'   => Brand::whereStatus(1)->whereIsPopular(1)->take(30)->get(),
      'products' => Item::with('category')->whereStatus(1),
      'home_page4_banner' => json_decode($home_customize->home_page4,true),
      'pupular_cateogry_home4' => isset($pupular_cateogry_home4) ? $pupular_cateogry_home4 : [],
      // feature category
      'feature_category_items' => $feature_category_items,
      'feature_categories' => $feature_categories,
      'feature_category_title' => $feature_category_title,
      // feature category
      'popular_category_items' => $popular_category_items,
      'popular_categories' => $popular_categories,
      'popular_category_title' => $popular_category_title,
      // two column category
      'two_column_categoriess' => $two_column_categoriess,
    ]);
	}
  public function review_submit(){
    return view('back.overlay.index');
  }
  public function slider_o_update(Request $request){
    $setting = Setting::find(1);
    $setting->overlay = $request->slider_overlay;
    $setting->save();
    return redirect()->back();
  }
  public function product($slug){
    $item = Item::with('category')->whereStatus(1)->whereSlug($slug)->get();

    $couponAddToItem = [];
    if(Auth::check()){
      if(!empty(auth()->user()) || auth()->user() != ""){
        $user = Auth::user();
        $iduser = $user->id;
        $idprod = $item[0]->id;
        $idcoupon = $item[0]->coupon_id;        
        
        $applyCouponValid = ApplyCoupon::where('id_user','=',$iduser)->where('id_prod','=',$idprod)->where('id_coupon','=',$idcoupon)->take(1)->get()->toArray();

        // echo "<pre>";
        // print_r($applyCouponValid);
        // echo "</pre>";

        if(count($applyCouponValid) > 0){
          $couponAddToItem = $applyCouponValid;
        }else{
          $couponAddToItem = ApplyCoupon::where('id_coupon','=',$item[0]->coupon_id)->take(1)->get();
        }
      }else{
        $couponAddToItem = ApplyCoupon::where('id_coupon','=',$item[0]->coupon_id)->take(1)->get();
      }
    }else{
      $couponAddToItem = ApplyCoupon::where('id_coupon','=',$item[0]->coupon_id)->take(1)->get();
    }
    // echo "<pre>";
    // print_r($couponAddToItem);
    // echo "</pre>";
    // exit();

    $itemsProd = "";
    if(isset($item) && !empty($item) && count($item) > 0){
      $itemProd = $item[0];
    }else{
      return view('front.catalog.catalog');
    }
    // $coupon = Item::with('coupons')->where('coupon_id','=',$item[0]->coupon_id)->get();
    $video = "";
    if($item[0]->video != "" && $item[0]->video != "null" && $item[0]->video != null){
      $video = explode('=',$item[0]->video);
      $video = end($video);
    }
    return view('front.catalog.product',[
      'item'          => $itemProd,
      'reviews'       => $item[0]->reviews()->where('status',1)->paginate(3),
      'galleries'     => $item[0]->galleries,
      'video'         => $video,
      'sec_name'      => isset($item[0]->specification_name) ? json_decode($item[0]->specification_name,true) : [],
      'sec_details'   => isset($item[0]->specification_description) ? json_decode($item[0]->specification_description,true) : [],
      'attributes'    => $item[0]->attributes,
      'related_items' => $item[0]->category->items()->whereStatus(1)->where('id','!=',$item[0]->id)->take(8)->get(),
      'coupons'       => Coupons::where('id','=',$item[0]->coupon_id)->where("status","!=",0)->take(1)->get(),
      // 'applycoupon'   => json_encode($couponAddToItem, TRUE)
      'applycoupon'   => $couponAddToItem
    ]);
  }
  public function brands(){
    if(Setting::first()->is_brands == 0){
      return back();
    }
    return view('front.brand',[
      'brands' => Brand::whereStatus(1)->get()
    ]);
  }
  public function allCategories(){
    $category = Category::get();
    
    return view('front.allcategories',[
      'category' => $category
    ]);
  }
	public function blog(Request $request){
    $tagz = '';
    $tags = null;
    $name = Post::pluck('tags')->toArray();
    foreach($name as $nm){
      $tagz .= $nm.',';
    }
    $tags = array_unique(explode(',',$tagz));
    if(Setting::first()->is_blog == 0) return back();
    if($request->ajax()) return view('front.blog.list',['posts' => $this->repository->displayPosts($request)]);
    return view('front.blog.index',['posts' => $this->repository->displayPosts($request),
      'recent_posts'       => Post::orderby('id','desc')->take(4)->get(),
      'categories' => \App\Models\Bcategory::withCount('posts')->whereStatus(1)->get(),
      'tags'       => array_filter($tags)
    ]);
	}
  public function blogDetails($id){
    $items = $this->repository->displayPost($id);
    return view('front.blog.show',[
      'post' => $items['post'],
      'categories' => $items['categories'],
      'tags' => $items['tags'],
      'posts' => $items['posts'],
    ]);
  }
  // ------------------ FAQ ------------------
	public function faq(){
    if(Setting::first()->is_faq == 0){
      return back();
    }
    $fcategories =  Fcategory::whereStatus(1)->withCount('faqs')->latest('id')->get();
		return view('front.faq.index',['fcategories' => $fcategories]);
	}
	public function show($slug){
    if(Setting::first()->is_faq == 0){
      return back();
    }
    $category =  Fcategory::whereSlug($slug)->first();
    return view('front.faq.show',['category' => $category]);
	}
  // ------------------ CAMPAIGN ------------------
	public function compaignProduct(){
    if(Setting::first()->is_campaign == 0){
      return back();
    }
    $compaign_items =  CampaignItem::whereStatus(1)->orderby('id','desc')->get();
    return view('front.campaign',['campaign_items' => $compaign_items]);
	}
  // ------------------ CURRENCY ------------------
  public function currency($id){
    Session::put('currency',$id);
    return back();
  }
  // ------------------ LANGUAGE ------------------
  public function language($id){
    Session::put('language',$id);
    return back();
  }
  // ------------------ SLUG ------------------
  public function page($slug){
    return view('front.page',[
      'page' => $this->repository->displayPage($slug)
    ]);
  }
  // ------------------ CONTACT ------------------
	public function contact(){
    if(Setting::first()->is_contact == 0){
      return back();
    }
		return view('front.contact');
	}
  // ------------------ ENVIAR CORREO DESDE LA PÁGINA DE CONTACTO EN EL LADO DEL USUARIO...
  public function contactEmail(Request $request){
    $request->validate([
      'first_name' => 'required|max:50',
      'last_name' => 'required|max:50',
      'email' => 'required|email|max:50',
      'phone' => 'required|max:50',
      'message' => 'required|max:250',
    ]);
    $input = $request->all();
    $setting = Setting::first();
    $name  = $input['first_name'].' '.$input['last_name'];
    $subject = $name;
    $to = $setting->contact_email;
    $phone = $request->phone;
    $from = $request->email;
    $msg = "Nombre: ".$name."<br/>Email: ".$from."<br/>Teléfono: ".$phone."<br/>Mensaje: ".$request->message;
    $emailData = [
      'to' => $to,
      'subject' => $subject,
      'body' => $msg,
    ];
    $mail = new PHPMailer(true);    
    try {
      $mail->CharSet = 'UTF-8';
      //Server settings
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host       = $setting->email_host;
      $mail->SMTPAuth   = true;
      $mail->Username   = $setting->email_user;
      $mail->Password   = $setting->email_pass;
      $mail->SMTPSecure = $setting->email_encryption;
      $mail->Port       = $setting->email_port; //587;
      
      //Recipients
      $mail->setFrom($setting->email_from, $setting->email_from_name);
      //foreach($correo as $val){
      $mail->addAddress($from); // COLOCAR EL EMAIL DE LA EMPRESA, YA QUE, ESTE MENSAJE ES DEDICADO Y/O DIRIGIDO HACIA ELLA...
      //}
      // Content
      $mail->isHTML(true);
      $mail->Subject = "Hola, " . $emailData['subject'];
      
      $mail->Body    =  '<!DOCTYPE html>
      <html lang="es">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style type="text/css">
          body{
            display:flex;align-items:center;justify-content:center;background: rgba(0,0,0,.05);padding: 2.2rem 0 2.2rem 0;
          }
          tr,td{
            border: none !important;
          }
          .cMCont{
            width: 85%;margin: auto;border-radius: 20px;background-position: center;background-repeat: no-repeat;background-size: contain;
          }
          .cMCont__c{
            width: 100%;background: rgba(255,255,255,.7);border-radius: 20px;border: #eee;box-shadow: 0 18px 24px 1px rgba(0,0,0,.1);
          }
          .cMCont__c__cTbl{
            width: 100%;background: rgba(255,255,255,.75);border-radius: 20px;margin: auto;
          }
          .cMCont__c__cTbl__cLogo{
            background-color: #003399;
            display:block;align-items:center;justify-content:center;text-align:center;padding: 1rem 2.8rem 0 2.8rem;
          }
          .cMCont__c__cTbl__cLogo img{
            max-width: 260px;min-width: 150px;width: 95%;
          }
          .cMCont__c__cTbl__cTitle{
            color:#3c4858;text-align:center;font-size: 1rem;
          }
          .cMCont__c__cTbl__cBodyMssg{
            color: #000;
          }
          .cMCont__c__cTbl__cC{
            display:block;align-items:center;justify-content:center;text-align:center;padding: .5rem 2.8rem 2.8rem 2.8rem;font-size: .97rem;font-weight: lighter;
          }
          .cMCont__c__cTbl__cC__c{
            margin-bottom:40px;text-align: center;color:#3c4858;
          }
          .cMCont__c__cTbl__cC__c__cTitle-1{
            text-align:left;
          }
          .cMCont__c__cTbl__cC__c__cTitle-h3{
            color:#3c4858;font-weight:bold;
          }
          .cMCont__c__cTbl__cC__c__paragraph{
            text-align:left;
          }
          .cMCont__c__cTbl__cC__c__link{
            text-decoration: none !important;color: #fff !important;background-color: #FD4259;border-radius: 1.5rem;padding: 1rem 2rem;display: inline-block;
          }
        </style>
      </head>
      <body>
        <div class="cMCont">
          <div class="cMCont__c">
            <table class="cMCont__c__cTbl" rules="all">
                <thead>
                  <td>
                    <tr>
                      <div class="cMCont__c__cTbl__cLogo">
                        <img src="https://grupocorein/assets/images/1669085546GRUPO-COREIN-LOGOTIPO.png" alt="logo_planverde">
                      </div>
                    </tr>
                    <tr>
                      <div class="cMCont__c__cTbl__cTitle">
                        <span>Nuevo mensaje</span>
                      </div>
                    </tr>
                    <tr>
                      <div class="cMCont__c__cTbl__cBodyMssg">
                        <span><strong>Nombre: </strong>"'.$name.'"</span><br/>
                        <span><strong>Email: </strong>"'.$from.'"</span><br/>
                        <span><strong>Teléfono: </strong>"'.$phone.'"</span><br/>
                        <span><strong>Mensaje: </strong>"'.$request->message.'"</span><br/>
                      </div>
                    </tr>
                    <div class="cMCont__c__cTbl__cC">
                      <div class="cMCont__c__cTbl__cC__c">
                        <p class="cMCont__c__cTbl__cC__c__paragraph">Hola, .<strong>"'.$name.'"</strong></p>
                        <p class="cMCont__c__cTbl__cC__c__paragraph">Gracias por contactar con nosotros, nos pondremos en contacto con usted en breve.</p>
                        <a class="cMCont__c__cTbl__cC__c__link" href="https://grupocorein.com/" title="Ir a grupocorein.com">
                          <span>Ir a Inicio</span>
                        </a>
                        <p class="cMCont__c__cTbl__cC__c__paragraph">No responda a este correo electrónico.</p>
                      </div>
                      <h3 class="cMCont__c__cTbl__cC__c__cTitle-h3">El equipo de grupocorein.com</h3>
                      <small class="cMCont__c__cTbl__cC__smallFooter">Mensaje enviado desde CONTACTO, en https://grupocorein.com</small>
                    </div>
                  </td>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div>
        </div>
      </body>
      </html>';
      
      $mail->send();
      $r = array(
        'r' => 'true'
      );
    }catch(Exception $e){
      echo "Ocurrio un error al enviar el correo. Error: {$mail->ErrorInfo}";
      $r = array(
        'r' => 'false'
      );
    }


    // $email = new EmailHelper();
    // $email->sendCustomMail($emailData);
    // exit();
    Session::flash('success',__('Gracias por contactar con nosotros, nos pondremos en contacto con usted en breve.'));
    return redirect()->back();
  }

  // ------------------ REVIEW ------------------
  public function reviews(){
    return view('front.reviews');
  }

  public function topReviews(){
    return view('front.top-reviews');
  }

  public function reviewSubmit(ReviewRequest $request){
    return response()->json($this->repository->reviewSubmit($request));
  }

  // ------------------ SUBSCRIBE ------------------
  public function subscribeSubmit(SubscribeRequest $request){
    Subscriber::create($request->all());
    return response()->json(__('Te has suscrito con éxito.'));
  }

  // ----------------------- TRACK ORDER ------------------//
  public function trackOrder(){
    return view('front.track_order');
  }

  public function track(Request $request){
    $order = Order::where('transaction_number',$request->order_number)->first();
    if($order){
      return view('user.order.track',[
        'numbers' => 3,
        'track_orders' => TrackOrder::whereOrderId($order->id)->get()->toArray()
      ]);
    }else{
      return view('user.order.track',[
        'numbers' => 3,
        'error' => 1,
      ]);
    }
  }

  public function maintainance(){
    $setting = Setting::first();
    if($setting->is_maintainance == 0){
      return redirect(route('front.index'));
    }
    return view('front.maintainance');
  }

  public function finalize(){
    return redirect(route('front.index'));
  }

  // ------------------ NUEVO CONTENIDO ------------------
  // ------------------ ON SALE PRODUCTS ------------------
	public function onsaleproducts(){
    $onsaleproducts_items = Item::where('sections_id','=',1)->orderby('id','desc')->whereStatus(1)->get();
    return view('front.onsaleproducts.index', compact('onsaleproducts_items'));
	}
  // ------------------ SPECIAL OFFER PRODUCTS ------------------
	public function specialofferProduct(){
    $specialoffer_items = Item::where('sections_id','=',2)->orderby('id','desc')->whereStatus(1)->get();
    return view('front.specialofferproducts.index', compact('specialoffer_items'));
	}
  // ------------------ SPECIAL OFFER PRODUCTS ------------------
	public function getProductByCategoryName(Request $request){
    
    // echo "<pre>";
    // print_r($request['category']);
    // echo "<pre>";
    // exit();
    
    return redirect('/catalog?category='. $request['category']);
    /*
    $specialoffer_items = Item::with('category')->where('name','like', '%'.$sku.'%')->orderby('id','desc')->whereStatus(1)->get();
    return view('front.specialoffer', compact('specialoffer_items'));
    */
	}
  /* ---------------------- FILTRAR - CATÁLOGOS ---------------------- */
  public function getCatalogsByAnio(Request $request){
    $setting = Setting::first();
    $sorting = $request->has('sorting_cataloganio') ?  ( !empty($request->sorting_cataloganio) ? $request->sorting_cataloganio : null ) : null;
    // $yDate = str_replace("y-","",$sorting);
    $catalogos = Catalog::when($sorting, function($query, $sorting){
      $yDate = str_replace("y-","",$sorting);
      if($sorting != ""){
        return $query->where(Catalog::raw('YEAR(created_at)'), '=', $yDate);
      }else{
        return $query->orderby('id','desc');
      }
    })
    ->where('status',1)->orderby('id','desc')->paginate($setting->view_product);
    $blade = 'front.journals.index';
    if($request->ajax()) $blade = 'front.journals.filter';
    return view($blade,[ 'catalogos' => $catalogos ]);
    // return view('front.journals.filter',compact('catalogos'));
  }
  /* ---------------------- FILTRAR - MARCAS ---------------------- */
  public function getBrandsByLetter(Request $request){
    $setting = Setting::first();
    $sorting = $request->has('sorting_brandletter') ?  ( !empty($request->sorting_brandletter) ? $request->sorting_brandletter : null ) : null;
    
    $brands = Brand::when($sorting, function($query, $sorting){
      $letterBrand = str_replace("letter-","",$sorting);
      if($sorting != ""){
        if($sorting == "#"){
          // return $query->where(Brand::raw("SUBSTRING(name, 1, 1)", "REGEXP", "^[0-9]"));
          // return $query->where(Brand::raw('name'), 'LIKE', '[0-9]%');
          return $query->where('name', 'LIKE', '[0-9]%');
          // return $query->where(Brand::whereRaw("name REGEXP '^[0-9]'"));
        }else{
          return $query->where('name', 'LIKE', $letterBrand . '%')->selectRaw('*, LEFT(name, 1) as first_char');
        }
      }else{
        return $query->orderby('id','asc');
      }
    })
    ->where('status',1)->orderby('id','asc')->paginate($setting->view_product);
    $blade = 'front.brands.index';
    if($request->ajax()) $blade = 'front.brands.filter';
    return view($blade,[ 'brands' => $brands ]);
    // return view('front.journals.filter',compact('catalogos'));
  }
  public function getFilterOnSaleProducts(Request $request){
    /*
    echo "<pre>";
    print_r($request->all());
    echo "</pre>";
    exit();
    */
    
    // attribute search
    $attr_item_ids = [];
    if($request->attribute){
      $attrubutes_get = Attribute::where('name',$request->attribute)->get();
      foreach($attrubutes_get as $attr_item_id){
        $attr_item_ids[] = $attr_item_id->item_id;
      }
    }

    $option_attr_ids = [];
    if($request->option){
      $option_get = AttributeOption::whereIn('name',explode(',',$request->option))->get();
      foreach($option_get as $option_attr_id){
        $option_attr_ids[] = $option_attr_id->attribute_id;
      }
    }

    $option_wise_item_ids = [];
    foreach(Attribute::whereIn('id',$option_attr_ids)->get() as $attr_item_id){
      $option_wise_item_ids[] = $attr_item_id->item_id;
    }
    $setting = Setting::first();
    $sorting = $request->has('sorting') ?  ( !empty($request->sorting) ? $request->sorting : null ) : null;
    $new = $request->has('new') ?  ( !empty($request->new) ? 1 : null ) : null;
    $feature = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'feature') ? 1 : null ) : null;
    $top = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'top') ? 1 : null ) : null;
    $best = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'best') ? 1 : null ) : null;
    $new = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'new') ? 1 : null ) : null;
    $sections_id = 1;
    $brand = $request->has('brand') ?  ( !empty($request->brand) ? Brand::whereSlug($request->brand)->firstOrFail() : null ) : null;
    $search = $request->has('search') ?  ( !empty($request->search) ? $request->search : null ) : null;
    $category = $request->has('category') ? ( !empty($request->category) ? Category::whereSlug($request->category)->firstOrFail() : null ) : null;
    $subcategory = $request->has('subcategory') ? ( !empty($request->subcategory) ? Subcategory::whereSlug($request->subcategory)->firstOrFail() : null ) : null;
    $childcategory = $request->has('childcategory') ? ( !empty($request->childcategory) ? ChieldCategory::where('slug',$request->childcategory)->first() : null ) : null;
    $minPrice = $request->has('minPrice') ?  ( !empty($request->minPrice) ? PriceHelper::convertPrice($request->minPrice) : null ) : null;
    $maxPrice = $request->has('maxPrice') ?  ( !empty($request->maxPrice) ? PriceHelper::convertPrice($request->maxPrice) : null ) : null;

    $items = Item::with('category')
    ->when($category, function ($query, $category){
      return $query->where('category_id', $category->id);
    })
    ->when($subcategory, function ($query, $subcategory){
      return $query->where('subcategory_id', $subcategory->id);
    })
    ->when($childcategory, function ($query, $childcategory){
      return $query->where('childcategory_id', $childcategory->id);
    })

    ->when($feature, function ($query){
      return $query->whereIsType('feature');
    })

    ->when($new, function ($query){
      return $query->orderby('id','desc');
    })
    ->when($top, function ($query){
      return $query->whereIsType('top');
    })
    ->when($best, function ($query){
      return $query->whereIsType('best');
    })
    ->when($new, function ($query){
      return $query->whereIsType('new');
    })
    ->when($sections_id, function ($query, $sections_id){
      return $query->where('sections_id', $sections_id);
    })
    ->when($brand, function ($query, $brand){
      return $query->where('brand_id', $brand->id);
    })
    ->when($search, function ($query, $search){
      return $query->whereStatus(1)->where('name', 'like', '%' . $search . '%')
      /* -- NUEVO CONTENIDO (INICIO) -- */
      ->orWhere('sku', 'like', '%' . $search . '%')
      ->orWhere('sap_code', 'like', '%' . $search . '%')
      /* -- NUEVO CONTENIDO (FIN) -- */
      ->orwhere('name', 'like', '%' . $search . '%');
    })
    ->when($minPrice, function($query, $minPrice){
      return $query->where('discount_price', '>=', $minPrice);
    })

    ->when($maxPrice, function($query, $maxPrice){
      return $query->where('discount_price', '<=', $maxPrice);
    })

    ->when($sorting, function($query, $sorting){
      if($sorting == 'low_to_high'){
        return $query->orderby('discount_price','asc');
      }else{
        return $query->orderby('discount_price','desc');
      }
    })

    ->when($attr_item_ids, function($query, $attr_item_ids){
      return $query->whereIn('id',$attr_item_ids);
    })
    ->when($option_wise_item_ids, function($query, $option_wise_item_ids){
      return $query->whereIn('id',$option_wise_item_ids);
    })

    ->where('status',1)
    ->orderby('id','desc')->paginate($setting->view_product); 
    $attrubutes_check =[];   
    $options = AttributeOption::groupby('name')->select('attribute_id','name','id','keyword')->get();
    
    foreach($options as $option){
      if(!in_array(Attribute::withCount('options')->findOrFail($option->attribute_id)->keyword,$attrubutes_check)){
        $attrubutes_check[] = Attribute::withCount('options')->findOrFail($option->attribute_id)->keyword;
      }
    }    
    $attrubutes = [];
    foreach($attrubutes_check as $attr_new_get){
      $attrubutes[] = Attribute::whereKeyword($attr_new_get)->first();
    }
  
    $blade = 'front.catalog.index';
    if($request->view_check){
      Session::put('view_catalog',$request->view_check);
    }

    if(Session::has('view_catalog')){
      $checkType = Session::get('view_catalog');
      $name_string_count = 55;
    }else{
      Session::put('view_catalog','grid');
      $checkType = Session::get('view_catalog');
      $name_string_count = 38;
    }

    if($request->ajax()) $blade = 'front.catalog.catalog';

    return view($blade,[
      'attrubutes' => $attrubutes,
      'options' => $options,
      'brand' => $brand,
      'brand' => $brand,
      'brand' => $brand,
      'items' => $items,
      'name_string_count' => $name_string_count,
      'category' => $category,
      'subcategory' => $subcategory,
      'childcategory' => $childcategory,
      'checkType'  => $checkType,
      'brands' => Brand::withCount('items')->whereStatus(1)->get(),
      'categories' => Category::whereStatus(1)->orderby('serial','asc')->withCount(['items' => function($query){
        $query->where('status',1);
      }])->get(),
    ]);
  }
  public function getFilterSpecialOfferProducts(Request $request){
    // attribute search
    $attr_item_ids = [];
    if($request->attribute){
      $attrubutes_get = Attribute::where('name',$request->attribute)->get();
      foreach($attrubutes_get as $attr_item_id){
        $attr_item_ids[] = $attr_item_id->item_id;
      }
    }

    $option_attr_ids = [];
    if($request->option){
      $option_get = AttributeOption::whereIn('name',explode(',',$request->option))->get();
      foreach($option_get as $option_attr_id){
        $option_attr_ids[] = $option_attr_id->attribute_id;
      }
    }

    $option_wise_item_ids = [];
    foreach(Attribute::whereIn('id',$option_attr_ids)->get() as $attr_item_id){
      $option_wise_item_ids[] = $attr_item_id->item_id;
    }
    $setting = Setting::first();
    $sorting = $request->has('sorting') ?  ( !empty($request->sorting) ? $request->sorting : null ) : null;
    $new = $request->has('new') ?  ( !empty($request->new) ? 1 : null ) : null;
    $feature = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'feature') ? 1 : null ) : null;
    $top = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'top') ? 1 : null ) : null;
    $best = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'best') ? 1 : null ) : null;
    $new = $request->has('quick_filter') ?  ( !empty($request->quick_filter == 'new') ? 1 : null ) : null;
    $sections_id = 2;
    $brand = $request->has('brand') ?  ( !empty($request->brand) ? Brand::whereSlug($request->brand)->firstOrFail() : null ) : null;
    $search = $request->has('search') ?  ( !empty($request->search) ? $request->search : null ) : null;
    $category = $request->has('category') ? ( !empty($request->category) ? Category::whereSlug($request->category)->firstOrFail() : null ) : null;
    $subcategory = $request->has('subcategory') ? ( !empty($request->subcategory) ? Subcategory::whereSlug($request->subcategory)->firstOrFail() : null ) : null;
    $childcategory = $request->has('childcategory') ? ( !empty($request->childcategory) ? ChieldCategory::where('slug',$request->childcategory)->first() : null ) : null;
    $minPrice = $request->has('minPrice') ?  ( !empty($request->minPrice) ? PriceHelper::convertPrice($request->minPrice) : null ) : null;
    $maxPrice = $request->has('maxPrice') ?  ( !empty($request->maxPrice) ? PriceHelper::convertPrice($request->maxPrice) : null ) : null;

    $items = Item::with('category')
    ->when($category, function ($query, $category){
      return $query->where('category_id', $category->id);
    })
    ->when($subcategory, function ($query, $subcategory){
      return $query->where('subcategory_id', $subcategory->id);
    })
    ->when($childcategory, function ($query, $childcategory){
      return $query->where('childcategory_id', $childcategory->id);
    })

    ->when($feature, function ($query){
      return $query->whereIsType('feature');
    })

    ->when($new, function ($query){
      return $query->orderby('id','desc');
    })
    ->when($top, function ($query){
      return $query->whereIsType('top');
    })
    ->when($best, function ($query){
      return $query->whereIsType('best');
    })
    ->when($new, function ($query){
      return $query->whereIsType('new');
    })
    ->when($sections_id, function ($query, $sections_id){
      return $query->where('sections_id', $sections_id);
    })
    ->when($brand, function ($query, $brand){
      return $query->where('brand_id', $brand->id);
    })
    ->when($search, function ($query, $search){
      return $query->whereStatus(1)->where('name', 'like', '%' . $search . '%')
      /* -- NUEVO CONTENIDO (INICIO) -- */
      ->orWhere('sku', 'like', '%' . $search . '%')
      ->orWhere('sap_code', 'like', '%' . $search . '%')
      /* -- NUEVO CONTENIDO (FIN) -- */
      ->orwhere('name', 'like', '%' . $search . '%');
    })
    ->when($minPrice, function($query, $minPrice){
      return $query->where('discount_price', '>=', $minPrice);
    })

    ->when($maxPrice, function($query, $maxPrice){
      return $query->where('discount_price', '<=', $maxPrice);
    })

    ->when($sorting, function($query, $sorting){
      if($sorting == 'low_to_high'){
        return $query->orderby('discount_price','asc');
      }else{
        return $query->orderby('discount_price','desc');
      }
    })

    ->when($attr_item_ids, function($query, $attr_item_ids){
      return $query->whereIn('id',$attr_item_ids);
    })
    ->when($option_wise_item_ids, function($query, $option_wise_item_ids){
      return $query->whereIn('id',$option_wise_item_ids);
    })

    ->where('status',1)
    ->orderby('id','desc')->paginate($setting->view_product); 
    $attrubutes_check =[];   
    $options = AttributeOption::groupby('name')->select('attribute_id','name','id','keyword')->get();
    
    foreach($options as $option){
      if(!in_array(Attribute::withCount('options')->findOrFail($option->attribute_id)->keyword,$attrubutes_check)){
        $attrubutes_check[] = Attribute::withCount('options')->findOrFail($option->attribute_id)->keyword;
      }
    }    
    $attrubutes = [];
    foreach($attrubutes_check as $attr_new_get){
      $attrubutes[] = Attribute::whereKeyword($attr_new_get)->first();
    }
  
    $blade = 'front.catalog.index';
    if($request->view_check){
      Session::put('view_catalog',$request->view_check);
    }

    if(Session::has('view_catalog')){
      $checkType = Session::get('view_catalog');
      $name_string_count = 55;
    }else{
      Session::put('view_catalog','grid');
      $checkType = Session::get('view_catalog');
      $name_string_count = 38;
    }

    if($request->ajax()) $blade = 'front.catalog.catalog';

    return view($blade,[
      'attrubutes' => $attrubutes,
      'options' => $options,
      'brand' => $brand,
      'brand' => $brand,
      'brand' => $brand,
      'items' => $items,
      'name_string_count' => $name_string_count,
      'category' => $category,
      'subcategory' => $subcategory,
      'childcategory' => $childcategory,
      'checkType'  => $checkType,
      'brands' => Brand::withCount('items')->whereStatus(1)->get(),
      'categories' => Category::whereStatus(1)->orderby('serial','asc')->withCount(['items' => function($query){
        $query->where('status',1);
      }])->get(),
    ]);
  }
  /* ------------------- NUEVO CONTENIDO ------------------- */
  public function getAllDepartamentos(){
    $departamentos = Departamento::get()->toArray();
    $data = $departamentos;
    return response()->json(['data'=>$data]);
  }
  public function getProvinciaByIdDepartamento(Request $request){
    if(isset($request->departamento_code) && $request->departamento_code != "undefined"){
      if($request->departamento_code){
        $provincias = Provincia::where('departamento_code', $request->departamento_code)->get()->toArray();
        $data = $provincias;
      }else{
        $data = [];
      }
    }else{
      $data = [];
    }
    return response()->json(['data'=>$data]);
  }
  public function getDistritoByIdProvincia(Request $request){
    if($request->provincia_code){
      $distritos = Distrito::where('provincia_code', $request->provincia_code)->get()->toArray();
      $data = $distritos;
    }else{
      $data = [];
    }
    return response()->json(['data'=>$data]);
  }
  public function getAmmountDispathByDistrito(Request $request){
    if(isset($request->departID) && $request->departID != "undefined" && 
       isset($request->provID) && $request->provID != "undefined" &&
       isset($request->distrID) && $request->distrID != "undefined"){
      $distritoByIdDistrito = Distrito::where('id', $request->distrID)->first()->toArray();
      if(count($distritoByIdDistrito) != 0){
        $data = [
          'min_amount' => $distritoByIdDistrito['distrito_min_amount'],
          'max_amount' => $distritoByIdDistrito['distrito_max_amount'],
        ];
      }else{
        $data = [];
      }
    }else{
      $data = [];
    }
    return response()->json(['data'=>$data]);
  }
  public function getAllBrands(Request $request){
    $brands = Brand::select("id","name","slug")->get()->toArray();
    $data = $brands;
    return response()->json(['data'=>$data]);
  }
  public function removeVarsColorsByIdProd(Request $request){
    $cart = Session::get('cart', []);
    $itemId = $request->id_prod;
    if(isset($cart)){
      $cart[$itemId.'-']['attribute_collection'] =  json_encode(['attr_color_code' => "0",'attr_color_name' => "0"], TRUE);
      $idItem = str_replace('-','',$itemId);
      Session::put('cart', $cart);
      if(Auth::check() && Auth::user()->role !== 'admin'){
        if(!empty(auth()->user()) || auth()->user() != ""){
          TempCart::where("user_id", "=", Auth::user()->id)->where("item_id", "=", $idItem)->update(['attribute_collection' => json_encode(['attr_color_code' => "0",'attr_color_name' => "0"], TRUE)]);
        }
      }
    }
    return response()->json(['res' => "true"]);
  }
  public function updateVarsColorByIdProd(Request $request){
    $cart = Session::get('cart', []);
    $itemId = $request->id_prod;
    
    if(isset($cart)){
      $idProd = $itemId['id_prod'];
      $color_code = $itemId['color_code'];
      $color_name = $itemId['color_name'];
      if($color_code != "0" && $color_name != "0"){
        $arrAttrCollection = [
          "atributoraiz_collection" => [
            "color" => [
              'code' => $color_code,
              'name' => $color_name
            ]
          ]
        ];
        if(isset($cart[$idProd.'-']['qty'])){
          $cart[$idProd.'-']['attribute_collection'] =  json_encode($arrAttrCollection, TRUE);
          $idItem = str_replace('-','',$idProd);
          Session::put('cart', $cart);
          if(Auth::check() && Auth::user()->role !== 'admin'){
            if(!empty(auth()->user()) || auth()->user() != ""){
              TempCart::where("user_id", "=", Auth::user()->id)->where("item_id", "=", $idItem)->update(['attribute_collection' => json_encode($arrAttrCollection, TRUE)]);
            }
          }
        }
      }else{
        $arrAttrCollection = [
          "atributoraiz_collection" => [
            "color" => [
              'code' => "0",
              'name' => "0"
            ]
          ]
        ];
        if(isset($cart[$idProd.'-']['qty'])){
          $cart[$idProd.'-']['attribute_collection'] =  json_encode($arrAttrCollection, TRUE);
          $idItem = str_replace('-','',$idProd);
          Session::put('cart', $cart);
          if(Auth::check() && Auth::user()->role !== 'admin'){
            if(!empty(auth()->user()) || auth()->user() != ""){
              TempCart::where("user_id", "=", Auth::user()->id)->where("item_id", "=", $idItem)->update(['attribute_collection' => json_encode($arrAttrCollection, TRUE)]);
            }
          }
        }
      }
    }
    return response()->json(['res' => "true"]);

  }
  // FUNCIÓN PARA NO REDONDEAR LOS DECIMALES...
  function restrictDecimals($number, $decimals){
    $numberStr = strval($number);
    $decimalPos = strpos($numberStr, '.');
    if ($decimalPos !== false && strlen($numberStr) - $decimalPos - 1 > $decimals){
      $numberStr = substr($numberStr, 0, $decimalPos + $decimals + 1);
    }
    return $numberStr;
  }
  // ------------------- APLICAR CUPÓN AL PRODUCTO...
  public function applycoupon(Request $request){
   
    // NOTA: (03/05/2024) GUARDAR UNA SOLA VEZ EL CUPÓN POR PRODUCTO, VALIDAR EL ID DEL CLIENTE, ID DEL PRODUCTO E ID DEL CUPÓN
    // if(Auth::check()){
    //   if(!empty(auth()->user()) || auth()->user() != ""){
    //     $user = Auth::user();
    //     $iduser = $user->id;
    //     $idprod = $request->prod_id;
    //     $idcoupon = $request->coupon_id;
    //     $applyCouponValid = ApplyCoupon::where('id_user','=',$iduser)->where('id_prod','=',$idprod)->where('id_coupon','=',$idcoupon)->take(1)->get()->toArray();
    //     if(count($applyCouponValid) > 0){
    //       echo "YA APLICADO";
    //     }else{
    //       echo "NO APLICADO";
    //     }
    //   }else{
    //     echo "NO EXISTE USUARIO";
    //   }
    // }else{
    //   echo "NO EXISTE USUARIO";
    // }
    // exit();


    // INFORMACIÓN A UTILIZAR EN EL CÁLCULO...
    $TaxesAll = Tax::get();
    $sumFinalPrice1 = 0;
    $sumFinalPrice2 = 0;
    $incIGV = $TaxesAll[0]->value;
    $sinIGV = $TaxesAll[1]->value;
    $incIGV_format = $incIGV / 100;
    $sinIGV_format = $sinIGV;
    if(Auth::check()){
      if(!empty(auth()->user()) || auth()->user() != ""){
        $user = Auth::user();
        $iduser = $user->id;
        $idprod = $request->prod_id;
        $idcoupon = $request->coupon_id;
        
        $applyCouponValid = ApplyCoupon::where('id_user','=',$iduser)->where('id_prod','=',$idprod)->where('id_coupon','=',$idcoupon)->take(1)->get()->toArray();
        if(count($applyCouponValid) > 0){
          // REDIRIGIR A LA PÁGINA ANTERIOR(DETALLE DEL PRODUCTO) SI YA ESTÁ ACTIVADO EN ESTE PRODUCTO...
          return redirect()->back()->withSuccess(__('The coupon has already been activated on this product.'));
        }else{
          $coupon = Coupons::select('name','discount_percentage')->where('id','=',$idcoupon)->take(1)->get()->toArray();
          $item = Item::where('id','=',$idprod)->take(1)->get()->toArray();
          // CALCULO PARA EL DESCUENTO DEL PRECIO DEL PRODUCTO SEGÚN EL CUPÓN...
          $discount_percentage = $coupon[0]['discount_percentage'] / 100;

          if(isset($item[0]['sections_id']) && $item[0]['sections_id'] != 0){
            if($item[0]['sections_id'] == 1){
              if($item[0]['on_sale_price'] != 0 && $item[0]['on_sale_price'] != ""){
                if(isset($item[0]['tax_id']) && $item[0]['tax_id'] == 1){                
                    $sumFinalPrice1 = $item[0]['on_sale_price'] * $incIGV_format;
                    $sumFinalPrice2 = $item[0]['on_sale_price'] + $sumFinalPrice1;
                    $coupon_1 = $sumFinalPrice2 * $discount_percentage;
                    $coupon_2 = $sumFinalPrice2 - $coupon_1;
                    // echo number_format($coupon_2, 2)."<br>"; // REDONDEANDO LOS DECIMALES...
                    $finalprice = $this->restrictDecimals($coupon_2, 2); // SIN REDONDEAR LOS DECIMALES...
                    // echo $finalprice."<br>";
                }else{                
                  $sumFinalPrice1 = $item[0]['on_sale_price'];
                  $sumFinalPrice2 = $item[0]['on_sale_price'] + $sumFinalPrice1;
                  $coupon_1 = $sumFinalPrice2 * $discount_percentage;
                  $coupon_2 = $sumFinalPrice2 - $coupon_1;
                  $finalprice = $this->restrictDecimals($coupon_2, 2); // SIN REDONDEAR LOS DECIMALES...
                  // echo $finalprice."<br>";
                }
              }else{
                $discount_price = $item[0]['discount_price'];
                $coupon_1 = $discount_price * $discount_percentage;
                $coupon_2 = $discount_price - $coupon_1;
                $finalprice = $this->restrictDecimals($coupon_2, 2); // SIN REDONDEAR LOS DECIMALES...
                // echo $finalprice."<br>";
              }
            }else{
              if($item[0]['special_offer_price'] != 0 && $item[0]['special_offer_price'] != ""){
                if(isset($item[0]['tax_id']) && $item[0]['tax_id'] == 1){
                  $sumFinalPrice1 = $item[0]['special_offer_price'] * $incIGV_format;
                  $sumFinalPrice2 = $item[0]['special_offer_price'] + $sumFinalPrice1;
                  $coupon_1 = $sumFinalPrice2 * $discount_percentage;
                  $coupon_2 = $sumFinalPrice2 - $coupon_1;
                  $finalprice = $this->restrictDecimals($coupon_2, 2); // SIN REDONDEAR LOS DECIMALES...
                  // echo $finalprice."<br>";
                }else{                
                  $sumFinalPrice1 = $item[0]['special_offer_price'];
                  $sumFinalPrice2 = $item[0]['special_offer_price'] + $sumFinalPrice1;
                  $coupon_1 = $sumFinalPrice2 * $discount_percentage;
                  $coupon_2 = $sumFinalPrice2 - $coupon_1;
                  $finalprice = $this->restrictDecimals($coupon_2, 2); // SIN REDONDEAR LOS DECIMALES...
                  // echo $finalprice."<br>";
                }
              }else{
                $discount_price = $item[0]['discount_price'];
                $coupon_1 = $discount_price * $discount_percentage;
                $coupon_2 = $discount_price - $coupon_1;
                $finalprice = $this->restrictDecimals($coupon_2, 2); // SIN REDONDEAR LOS DECIMALES...
                // echo $finalprice."<br>";
              }
            }
          }else{
            $discount_price = $item[0]['discount_price'];
            $coupon_1 = $discount_price * $discount_percentage;
            $coupon_2 = $discount_price - $coupon_1;
            $finalprice = $this->restrictDecimals($coupon_2, 2); // SIN REDONDEAR LOS DECIMALES...
            // echo $finalprice."<br>";
          }

          // $user = User::findOrFail($user->id);
          $arrcoupon = array(
            'id_user' => $iduser,
            'id_prod' => $idprod,
            'id_coupon' => $idcoupon,
            'totalprice' => $finalprice,
            'status' => 1
          );
          // AGREGAR A LA TABLA "tbl_applycoupons"...
          $this->applycoupon->addToUser($arrcoupon);
          return redirect()->back()->withSuccess(__('New coupon activated successfully.'));          
        }        
      }else{
        // REDIRIGIR A INICIAR SESIÓN...
        return redirect(route('user.login'));
      }
    }else{
      // REDIRIGIR A INICIAR SESIÓN...
      return redirect(route('user.login'));
    }
  }
}