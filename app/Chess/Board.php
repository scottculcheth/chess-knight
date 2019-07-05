<?php

namespace App\Chess;

class Board
{
	protected $board;
	protected $rows = 8; // X
	protected $columns = 8; // Y

	public function __construct(int $rows = 8, int $columns = 8)
	{
		$this->rows = $rows;
		$this->columns = $columns;
		$this->initialiseBoard();
	}

	private function initialiseBoard()
	{
		$this->board = [];
		for( $i=1; $i<=$this->rows; $i++ ){
			for( $j=1; $j<=$this->columns; $j++ ){
				$this->board[$i][$j] = 0;
			}
		}
	}

	public function setVisited(int $x, int $y)
	{
		$this->board[$x][$y] = 1;
	}

	public function getVisited(int $x, int $y)
	{
		return $this->board[$x][$y];
	}

	public function getRows()
	{
		return $this->rows;
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function countVisited()
	{
		$count = 0;
		for( $i=1; $i<=$this->rows; $i++ ){
			for( $j=1; $j<=$this->columns; $j++ ){
				if( $this->board[$i][$j] ) $count ++;
			}
		}
		return $count;
	}

	public function countNotVisited()
	{
		$count = 0;
		for( $i=1; $i<=$this->rows; $i++ ){
			for( $j=1; $j<=$this->columns; $j++ ){
				if( !$this->board[$i][$j] ) $count ++;
			}
		}
		return $count;
	}
}