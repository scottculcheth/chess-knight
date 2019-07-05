<?php

namespace App\Chess\Knight;

use App\Chess\Board;

class DepthFirstKnight
{
	protected $start_x = 1;
	protected $start_y = 1;
	protected $board;
	protected $move_count;
	protected $reverse_move_count;

	public function __construct(Board $board) 
	{
		$this->board = $board;
		$this->move_count = 0;
		$this->reverse_move_count = 0;
	}

	public function navigate()
	{
		printf( '%s Navigating', self::class );
		$this->move($this->start_x, $this->start_y);
		printf( '<br/><br/>Unvisited Squares: %d', $this->board->countNotVisited());
		printf( '<br/>Moves Taken: %d', $this->move_count);
	}

	protected function move(int $x, int $y)
	{
		printf( '<br/>%d, %d', $x, $y );
		++$this->move_count;

		$this->move_count += $this->reverse_move_count;
		$this->reverse_move_count = 0;

		$this->board->setVisited($x, $y);

		do{
			$positions = $this->getNextPositions($x, $y);
			if( count( $positions ) ){
				$next = array_shift($positions);
				$this->move($next[0], $next[1]);
			}
		} while( count( $positions ) );
		++ $this->reverse_move_count;
		printf( '<br/>Backtracking: %d', $this->reverse_move_count );

		return;
	}

	protected function getNextPositions(int $x, int $y)
	{
		$positions = [];
		$this->calculateNextPositions($positions, $x, $y);
		$this->filterInvalidPositions($positions);
		$this->filterVisitedPositions($positions);
		return $positions;
	}

	protected function calculateNextPositions(array &$positions, int $x, int $y)
	{
		// better way to do this, surely.... but figure it out later, only 8 possible!
		$positions[] = [$x+1, $y+2];
		$positions[] = [$x+1, $y-2];
		$positions[] = [$x-1, $y+2];
		$positions[] = [$x-1, $y-2];		
		$positions[] = [$x+2, $y+1];
		$positions[] = [$x+2, $y-1];
		$positions[] = [$x-2, $y+1];
		$positions[] = [$x-2, $y-1];

	}

	protected function filterInvalidPositions( array &$positions )
	{
		$x_max = $this->board->getRows();
		$y_max = $this->board->getColumns();
		foreach( $positions as $key => $position ){
			if(    $position[0] > $x_max 
				|| $position[1] > $y_max
				|| $position[0] < 1
				|| $position[1] < 1  )
				unset( $positions[$key] );
		}
	}

	protected function filterVisitedPositions( array &$positions )
	{
		foreach($positions as $key => $position){
			if($this->board->getVisited($position[0], $position[1])){
				unset($positions[$key]);
			}
		}
	}
}