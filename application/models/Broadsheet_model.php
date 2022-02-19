<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Broadsheet_model extends CI_Model
{	
	public function insert($table,$values)
	{
		$query = $this->db->insert($table,$values);

		if($query)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	public function select($table,$where = "")
	{		
		$this->db->select("*");
		$this->db->from($table);
		if($where !="")
		{
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function update($table,$values,$where)
	{
		$query = $this->db->update($table,$values,$where);

		if($query)
		{
			return 1;
		}
		else
		{
			return 0;
		} 
	}
	
	public function delete($table,$where)
	{
    	$query = $this->db->delete($table,$where);

    	if($query)
    	{
    		return 1;
    	}
    	else
    	{
    		return 0;
    	} 
	}

	public function get_sections($where)
	{		
		$this->db->select("a.id,a.section");
		$this->db->from('sections as a');
		$this->db->join('class_sections as b','b.section_id = a.id');
		$this->db->where($where);		
		$query = $this->db->get();
		return $query;
	}

	public function get_subjects($where)
	{		
		$this->db->select("a.id,a.name");
		$this->db->from('subjects as a');
		$this->db->join('subject_group_subjects as b','b.subject_id = a.id');
		$this->db->join('subject_group_class_sections as c','c.subject_group_id = b.subject_group_id');
		$this->db->join('class_sections as d','d.id = c.class_section_id');
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	public function get_students($where)
	{		
		$this->db->select("a.id,a.admission_no,a.firstname,a.lastname");
		$this->db->from('students as a');
		$this->db->join('student_session as b','b.student_id = a.id');
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	public function get_marks($wherein)
	{
		$this->db->select("*,sum(get_marks) as total,sum(max_marks) as max_total");
		$this->db->from('exam_group_exam_results as a');
		$this->db->join('exam_group_class_batch_exam_students as b','b.id = a.exam_group_class_batch_exam_student_id');
		$this->db->join('exam_group_class_batch_exam_subjects as c','c.id = a.exam_group_class_batch_exam_subject_id');
		$this->db->where_in('student_id',$wherein);
		$this->db->group_by(['student_id','subject_id']);
		$query = $this->db->get();
		return $query;
	}

	public function get_exam_marks($wherein)
	{
		$this->db->select("*");
		$this->db->from('exam_group_exam_results as a');
		$this->db->join('exam_group_class_batch_exam_students as b','b.id = a.exam_group_class_batch_exam_student_id');
		$this->db->join('exam_group_class_batch_exam_subjects as c','c.id = a.exam_group_class_batch_exam_subject_id');
		$this->db->join('exam_group_class_batch_exams as d','d.id = c.exam_group_class_batch_exams_id');
		$this->db->where_in('student_id',$wherein);		
		$query = $this->db->get();
		return $query;
	}

	public function get_result_grade($where)
	{
		$this->db->select("*");
		$this->db->from('result_grade as a');
		$this->db->join('classes as b','b.id = a.result_grade_class');
		$this->db->join('sections as c','c.id = a.result_grade_term');		
		$this->db->where($where);
		$this->db->order_by('result_grade_id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_result_fees($where)
	{
		$this->db->select("*");
		$this->db->from('result_fees as a');
		$this->db->join('classes as b','b.id = a.result_fees_class');
		$this->db->join('sections as c','c.id = a.result_fees_term');		
		$this->db->where($where);
		$this->db->order_by('result_fees_id','desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_subject_grade($where)
	{
		$this->db->select("*");
		$this->db->from('subject_grade as a');
		$this->db->join('classes as b','b.id = a.subject_grade_class');
		$this->db->join('sections as c','c.id = a.subject_grade_term');		
		$this->db->where($where);
		$this->db->order_by('subject_grade_id','desc');
		$query = $this->db->get();
		return $query;
	}
}
?>