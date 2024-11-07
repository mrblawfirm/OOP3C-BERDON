<?php
class PieceWorker extends Employee
{
    private $piecesProduced;
    private $ratePerPiece;

    public function __construct($name, $address, $age, $companyName, $piecesProduced, $ratePerPiece)
    {
        parent::__construct($name, $address, $age, $companyName);
        $this->piecesProduced = $piecesProduced;
        $this->ratePerPiece = $ratePerPiece;
    }

    public function earnings()
    {
        return $this->piecesProduced * $this->ratePerPiece;
    }

    public function toString()
    {
        return parent::toString() . ", Pieces Produced: $this->piecesProduced, Rate per Piece: $this->ratePerPiece";
    }
}
?>