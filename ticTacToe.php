<?php
class TicTacToe
{
    private $board;
    private $currentPlayer;

    public function __construct()
    {
        $this->board = [[' ', ' ', ' '], [' ', ' ', ' '], [' ', ' ', ' ']];
        $this->currentPlayer = 'X';
    }

    public function play($row, $col)
    {
        if ($this->board[$row][$col] === ' ')
        {
            $this->board[$row][$col] = $this->currentPlayer;
            $this->currentPlayer = ($this->currentPlayer === 'X') ? 'O' : 'X';
        }
    }

    public function checkWin()
    {
        for ($i = 0;$i < 3;$i++)
        {
            if ($this->board[$i][0] !== ' ' && $this->board[$i][0] === $this->board[$i][1] && $this->board[$i][1] === $this->board[$i][2])
            {
                return $this->board[$i][0];
            }
        }

        for ($i = 0;$i < 3;$i++)
        {
            if ($this->board[0][$i] !== ' ' && $this->board[0][$i] === $this->board[1][$i] && $this->board[1][$i] === $this->board[2][$i])
            {
                return $this->board[0][$i];
            }
        }

        if ($this->board[0][0] !== ' ' && $this->board[0][0] === $this->board[1][1] && $this->board[1][1] === $this->board[2][2])
        {
            return $this->board[0][0];
        }

        if ($this->board[0][2] !== ' ' && $this->board[0][2] === $this->board[1][1] && $this->board[1][1] === $this->board[2][0])
        {
            return $this->board[0][2];
        }

        return null;
    }

    public function isBoardFull()
    {
        foreach ($this->board as $row)
        {
            if (in_array(' ', $row))
            {
                return false;
            }
        }
        return true;
    }

    public function displayBoard()
    {
        foreach ($this->board as $row)
        {
            echo implode(' | ', $row) . PHP_EOL;
            echo '---------' . PHP_EOL;
        }
        echo PHP_EOL;
    }

    public function getCurrentPlayer()
    {
        return $this->currentPlayer;
    }
}

$game = new TicTacToe();

while (true)
{
    $game->displayBoard();

    echo "Player {$game->getCurrentPlayer() }: Enter your move (row and column): ";
    $move = readline();
    list($row, $col) = explode(' ', $move);

    $game->play($row, $col);

    $winner = $game->checkWin();
    if ($winner)
    {
        $game->displayBoard();
        echo "Player $winner wins!" . PHP_EOL;
        break;
    }
    elseif ($game->isBoardFull())
    {
        $game->displayBoard();
        echo "It's a tie!" . PHP_EOL;
        break;
    }
}

?>
