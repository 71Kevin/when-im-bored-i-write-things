const express = require('express');
const app = express();

class CardDeck {
  constructor() {
    this.servantOneCards = 5;
    this.servantTwoCards = 5;
    this.servantThreeCards = 5;
    this.turn = 1;
  }

  drawCards() {
    if (this.getTotalCards() < 5) {
      this.resetDeck();
      return { error: 'Not enough cards in the deck. The deck has been reset.' };
    }
  
    let drawnCards = {
      servantOne: 0,
      servantTwo: 0,
      servantThree: 0
    };
  
    for (let i = 0; i < 5; i++) {
      let randomNumber = Math.random();
  
      if (randomNumber < cardProbabilities.servantOne && this.servantOneCards > 0) {
        drawnCards.servantOne++;
        this.servantOneCards--;
      } else if (randomNumber < cardProbabilities.servantOne + cardProbabilities.servantTwo && this.servantTwoCards > 0) {
        drawnCards.servantTwo++;
        this.servantTwoCards--;
      } else if (this.servantThreeCards > 0) {
        drawnCards.servantThree++;
        this.servantThreeCards--;
      } else {
        i--;
      }
    }
  
    const turn = this.turn;
    this.turn++;
    return { drawnCards, turn };
  }  

  getTotalCards() {
    return this.servantOneCards + this.servantTwoCards + this.servantThreeCards;
  }

  resetDeck() {
    this.servantOneCards = 5;
    this.servantTwoCards = 5;
    this.servantThreeCards = 5;
    this.turn = 1;
  }
}

const cardProbabilities = {
  servantOne: 0.33,
  servantTwo: 0.33,
  servantThree: 0.34
};

const cardDeck = new CardDeck();

app.get('/draw-cards', (req, res) => {
  const result = cardDeck.drawCards();
  if (result.error) {
    return res.status(400).json({ message: result.error });
  }
  res.json(result);
});

app.get('/deck', (req, res) => {
  res.json({
    servantOneCards: cardDeck.servantOneCards,
    servantTwoCards: cardDeck.servantTwoCards,
    servantThreeCards: cardDeck.servantThreeCards,
    turn: cardDeck.turn
  });
});

app.listen(3000, () => {
  console.log('Server started on port 3000');
});
