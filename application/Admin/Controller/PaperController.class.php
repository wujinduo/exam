<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class PaperController extends AdminbaseController
{
	public function index()
	{
        $ac_id = $_SESSION['ac_id'];
        $m = M('academy','ks_');
        $result = $m->table("ks_academy a")
                    ->join("inner join ks_course b on a.ac_id = b.co_academy_id")
                    ->where(array('ac_id'=>$ac_id))
                    ->select();
        $this->assign('result',$result);
        $this->display();
    }

    public function type()
    {
        $co_id = I('id','','intval');
        $course = M('course','ks_');
        $result = $course->table("ks_course a")
                         ->join("inner join ks_paper b on a.co_id = b.id")
                         ->where(array('pa_co_id'=>$co_id))
                         ->select();
        $this->assign('result',$result);
        $this->display();
    }

    public function exam()
    {
    	$id = I('id','','intval');
        $pa_time = I('pa_time','','trim');

        //选择题
        $m = M('choice','ks_');
        //选择题数量
        $count = $m->where(array('paper_id'=>$id))->count();
        $result = $m->where(array('paper_id'=>$id))->select();

        //填空题
        $m1 = M('fill','ks_');
        //填空题数量
        $count1 = $m1->where(array('fi_course_id'=>$id))->count();
        $result1 = $m1->where(array('fi_course_id'=>$id))->select();
        //简答题
        $m2 = M('saq','ks_');
        $count2 = $m2->where(array('sa_course_id'=>$id))->count();
        $result2 = $m2->where(array('sa_course_id'=>$id))->select();

        $this->assign('result2',$result2);
        $this->assign('result1',$result1);
        $this->assign('result',$result);
        $this->assign('id',$id);
        $this->assign('pa_time',$pa_time);
        $this->display();
    }
    public function create()
    {
        $m = M('course','ks_');
        $result = $m->select();
        $this->assign('result',$result);
        
        $this->display();
    }
    public function auto()
    {
        $data['pa_name'] =I('pa_name');
        $data['ch_num'] = I('ch_num');
        $data['ch_score'] = I('ch_score');
        $data['fill_num'] = I('fi_num');
        $data['fill_score'] = I('fi_score');
        $data['sa_num'] = I('sa_num');
        $data['sa_score'] = I('sa_score');
        $data['tf_num'] = I('tf_num');
        $data['tf_score'] = I('tf_score');
        $data['pa_co_id'] = I('co_id');
        $data['pa_time'] = I('pa_time');
        $paper = M('Paper','ks_');
        $result = $paper->insert($data);

        }   




    public function manual()
    {
        $this->display();

    }
    public function edit()
    {
        $this->display();
    }
    public function delete()
    {

    }
}