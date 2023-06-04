const express = require('express');
const app = express();

const rates = {
  SSR_Servant: 1, // 1% de chance
  SR_Servant: 3, // 3% de chance
  R_Servant: 40, // 40% de chance
  SSR_CE: 4, // 4% de chance
  SR_CE: 12, // 12% de chance
  R_CE: 40, // 40% de chance
};

rates.N_CE =
  100 -
  (rates.SSR_Servant +
    rates.SR_Servant +
    rates.R_Servant +
    rates.SSR_CE +
    rates.SR_CE +
    rates.R_CE);

function pullOnce() {
  const random = Math.random() * 100;

  if (random <= rates.SSR_Servant) {
    return 'SSR Servant';
  } else if (random <= rates.SSR_Servant + rates.SR_Servant) {
    return 'SR Servant';
  } else if (random <= rates.SSR_Servant + rates.SR_Servant + rates.R_Servant) {
    return 'R Servant';
  } else if (
    random <=
    rates.SSR_Servant + rates.SR_Servant + rates.R_Servant + rates.SSR_CE
  ) {
    return 'SSR Craft Essence';
  } else if (
    random <=
    rates.SSR_Servant +
      rates.SR_Servant +
      rates.R_Servant +
      rates.SSR_CE +
      rates.SR_CE
  ) {
    return 'SR Craft Essence';
  } else if (
    random <=
    rates.SSR_Servant +
      rates.SR_Servant +
      rates.R_Servant +
      rates.SSR_CE +
      rates.SR_CE +
      rates.R_CE
  ) {
    return 'R Craft Essence';
  } else {
    return 'Normal Craft Essence';
  }
}

app.get('/pull', (req, res) => {
  const result = pullOnce();
  res.json(result);
});

app.get('/pulls', (req, res) => {
  const counts = {
    SSR_Servant: 0,
    SR_Servant: 0,
    R_Servant: 0,
    SSR_CE: 0,
    SR_CE: 0,
    R_CE: 0,
    N_CE: 0,
    quantidade_de_pulls: 1100,
  };

  for (let i = 0; i < counts.quantidade_de_pulls; i++) {
    const result = pullOnce();

    switch (result) {
      case 'SSR Servant':
        counts.SSR_Servant++;
        break;
      case 'SR Servant':
        counts.SR_Servant++;
        break;
      case 'R Servant':
        counts.R_Servant++;
        break;
      case 'SSR Craft Essence':
        counts.SSR_CE++;
        break;
      case 'SR Craft Essence':
        counts.SR_CE++;
        break;
      case 'R Craft Essence':
        counts.R_CE++;
        break;
      case 'Normal Craft Essence':
        counts.N_CE++;
        break;
    }
  }

  res.json(counts);
});

app.listen(3000, () => {
  console.log('Servidor rodando na porta 3000');
});
