<?php
namespace Collect\Model;

use Think\Model;

class AsQuestionModel extends Model {
	protected $_validate = array (
			array (
					'question_content',
					'require',
					'问题标题必须写' 
			),
			array (
					'question_detail',
					'require',
					'问题内容必须写' 
			) 
	);
	protected $_auto = array (
			array (
					'status',
					1,
					self::MODEL_INSERT 
			),
			
			array (
					'create_time',
					NOW_TIME,
					self::MODEL_INSERT
			),
			array (
					'popular_value_update',
					NOW_TIME,
					self::MODEL_INSERT 
			),
			array (
					'update_time',
					NOW_TIME,
					self::MODEL_BOTH 
			),
			array (
					'last_ip',
					'get_client_ip',
					self::MODEL_INSERT,
					'function',
					1 
			) 
	);

	public function addQuestion($data) {
		$data = $this->create ( $data );
		if ($data) {
			$id = $this->add ( $data );
			return $id ? $id : 0;
		} else {
			return false;
		}
	}

	public function editQuestion($data) {
		$data = $this->create ( $data, 2 );
		if ($data) {
			$id = $this->save ( $data );
			return $id ? $id : 0;
		} else {
			return false;
		}
	}

	public function saveCollectAnswer($question_id, $answer_id) {
		 
		$data ['best_answer'] = $answer_id;
		$data ['last_answer'] = $answer_id;
		$data['question_id']=$question_id;
		$this->editQuestion($data);
	}
}
?>