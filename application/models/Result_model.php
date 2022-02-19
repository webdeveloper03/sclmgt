<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Result_model extends CI_Model
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

	public function student_details($where)
	{		
		$this->db->select("*");
		$this->db->from('students as a');
		$this->db->join('student_session as b','b.student_id = a.id');
		$this->db->join('sessions as c','c.id = b.session_id');
		$this->db->join('classes as d','d.id = b.class_id');
		$this->db->join('sections as e','e.id = b.section_id');
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	public function get_staff($where)
	{
		$this->db->select("*");
		$this->db->from('staff as a');
		$this->db->join('class_teacher as b','b.staff_id = a.id');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
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

	public function get_exams($where)
	{
		$this->db->select("*,sum(c.max_marks) as total");
		$this->db->from('exam_group_class_batch_exams as a');
		$this->db->join('exam_group_class_batch_exam_students as b','b.exam_group_class_batch_exam_id = a.id');
		$this->db->join('exam_group_class_batch_exam_subjects as c','c.exam_group_class_batch_exams_id = a.id');
		$this->db->where($where);
		$this->db->group_by('a.id');
		$query = $this->db->get();
		return $query;
	}

	public function get_exam_marks($where)
	{
		$this->db->select("*");
		$this->db->from('exam_group_exam_results as a');
		$this->db->join('exam_group_class_batch_exam_students as b','b.id = a.exam_group_class_batch_exam_student_id');
		$this->db->join('exam_group_class_batch_exam_subjects as c','c.id = a.exam_group_class_batch_exam_subject_id');
		$this->db->join('exam_group_class_batch_exams as d','d.id = c.exam_group_class_batch_exams_id');
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	public function get_recent_fees($table,$where)
	{		
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('result_fees_id','desc');
		$query = $this->db->get();
		return $query;
	}
}
?>