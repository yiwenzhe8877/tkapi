<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/12/24
 * Time: 13:38
 */
namespace app\componments\platformapi;

use app\componments\utils\HttpUtils;

class Hdk
{
    public $url='http://v2.api.haodanku.com/';
    public $apikey='lingdang';


    //商品列表
    /*
     *   nav 默认全部商品（1实时跑单商品，2爆单榜商品，3全部商品，4纯视频单，5聚淘专区）
         cid 商品类目：0全部，1女装，2男装，3内衣，4美妆，5配饰，6鞋品，7箱包，8儿童，9母婴，10居家，11美食，12数码，13家电，14其他，15车品，16文体（支持多类目筛选，如1,2获取类目为女装、男装的商品，逗号仅限英文逗号）
         back 1000 返回数量
     * */

    public function goodslist($page,$nav,$cid,$back){
        return $this->getData('itemlist/apikey/'.$this->apikey.'/nav/'.$nav.'/cid/'.$cid.'/back/'.$back.'/min_id/'.$page);
    }

    //定时拉取
    /*
     * start 小时点数，如0点是0、13点是13（最小值是0，最大值是23）
     * end 小时点数，如0点是0、13点是13（最小值是0，最大值是23）
     * back 	每页返回条数（请在1,2,10,20,50,100,120,200,500,1000中选择一个数值返回）
     * */
    public function timeupdate($page=1,$start,$end,$back){
        return $this->getData('timing_items/apikey/'.$this->apikey.'/start/'.$start.'/end/'.$end.'/back/'.$back.'/min_id/'.$page);
    }
    //更新商品
    /*
     * sort  	更新排序（1好单指数，2月销量，3近两小时销量，4当天销量，5在线人数，6活动开始时间）
     * back
     * */
    public function updategoods($page,$sort,$back){
        return $this->getData('update_item/apikey/'.$this->apikey.'sort/'.$sort.'/back/'.$back.'/min_id/'.$page);
    }
    /*
     * 失效商品
     * start 0
     * end  23
     * */
    public function failgoods($start,$end){
        return $this->getData('get_down_items/apikey/'.$this->apikey.'/start/'.$start.'/end/'.$end);
    }

    /*
     * 各大版单
     * sale_type榜单类型：sale_type=1是实时销量榜（近2小时销量），type=2是今日爆单榜，type=3是昨日爆单榜，type=4是出单指数版
     * */
    public function sales_list($sale_type){
        return $this->getData('sales_list/apikey/'.$this->apikey.'/sale_type/'.$sale_type);

    }
    /*
     * 达人说
     *
     * */
    public function talent_info(){
        return $this->getData('talent_info/apikey/'.$this->apikey);
    }
    //快抢
    //快抢时间点：1.昨天的0点，2.昨天10点，3.昨天12点，4.昨天15点，5.昨天20点，6.今天的0点，7.今天10点，8.今天12点，9.今天15点，10.今天20点，11.明天的0点，12.明天10点，13.明天12点，14.明天15点，15.明天20点
    public function fastbuy($page=1,$hour_type=1){
        return $this->getData('fastbuy/apikey/'.$this->apikey.'/hour_type/'.$hour_type.'/min_id/'.$page);
    }
    /*
     * 好货专场
     * min_id
     * */
    public function subject_hot($page=1){
        return $this->getData('subject_hot/apikey/'.$this->apikey.'/mid_id/'.$page);
    }
    /*
     * 精选单品
     *
     * */
    public function selected_item($page){
        return $this->getData('selected_item/apikey/'.$this->apikey.'/mid_id/'.$page);
    }

    /*
     * 关键词商品页
     * 0.综合（最新），1.券后价(低到高)，2.券后价（高到低），3.券面额，4.销量，5.佣金比例，6.券面额（低到高），7.月销量（低到高），8.佣金比例（低到高），9.全天销量（高到低），10全天销量（低到高），11.近2小时销量（高到低），12.近2小时销量（低到高），13.优惠券领取量（高到低）
     * */
    public function get_keyword_items($keyword,$back,$sort,$shopid=''){
        $url='get_keyword_items/apikey/'.$this->apikey.'/keyword/'.urlencode($keyword).'/back/'.$back;
        if($shopid!=''){
            $url.='/shopid/'.$shopid;
        }
        return $this->getData($url);
    }
    /*
     * 热搜关键词记录
     * */
    public function hot_key(){
        return $this->getData('hot_key/apikey/'.$this->apikey);
    }

    /*
     * 超级分类
     * */
    public function super_classify($keyword,$back,$sort,$cid){
        return $this->getData('get_keyword_items/apikey/'.$this->apikey.'/keyword/'.urlencode(urlencode($keyword)).'/back/'.$back.'/sort/'.$sort.'/cid/'.$cid);
    }

    /*
     * 精选专题
     *
     * */
    public function get_subject(){
        return $this->getData('get_subject/apikey/'.$this->apikey);
    }

    /*
     * 精选专题商品
     * */
    public function get_subject_item($id){
        return $this->getData('get_subject_item/apikey/'.$this->apikey.'/id/'.$id);
    }


    /*
     * 商品详情
     * */
    public function item_detail($id){
        return $this->getData('item_detail/apikey/'.$this->apikey.'/itemid/'.$id);
    }

    /*
     * 猜你喜欢
     * 商品id
     * */
    public function get_similar_info($id){
        return $this->getData('get_similar_info/apikey/'.$this->apikey.'/itemid/'.$id);
    }
    /*
     * 精编文案
     *
     * */
    public function excellent_editor(){
        return $this->getData('excellent_editor/apikey/'.$this->apikey);

    }

    /*
     * 今日值得买
     * */
    public function get_deserve_item(){
        return $this->getData('get_deserve_item/apikey/'.$this->apikey);

    }

    /*
     * 超级搜索
     * https://www.haodanku.com/api/detail/show/19.html
     * http://v2.api.haodanku.com/supersearch/apikey/你的apikey/keyword/%25e5%25a5%25b3%25e8%25a3%2585/back/10/min_id/1/tb_p/1/sort/0/is_tmall/0/is_coupon/0/limitrate/0
     * */


    public function getData($param){
        return HttpUtils::get($this->url.$param,'','','','','');
    }
}