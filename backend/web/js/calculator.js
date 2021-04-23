new Vue({
  el: '#calculator',
  data: {
    s: 0,
    p: 0,
    m: 0,
    w: 0,
    h: 0,
    r: 0,
    pr: 0,
    pt: 0,
    lam: 0,
    percent: 0,
    calcConfig: [
      [0, 0, 0],
      [1, 0, 0],
      [0, 1, 0],
      [1, 1, 0],
      [0, 1, 1],
      [1, 1, 1],
    ],
  },
  computed: {
    kv() {
      return this.sizeWithReserve(this.w) * this.sizeWithReserve(this.h);
    },
    pl() {
      return this.kv * this.p;
    },
    mm() {
      return this.kv * this.m;
    },
    por() {
      return this.r * this.pr + this.pl + this.mm;
    },
    pors() {
      return this.formatPrint(this.por * this.s);
    },
    porWithPercent() {
      return this.formatPrint(this.pors + this.getPercent(this.pors, this.percent));
    },
    titles() {
      var $vm = this;
      var title;
      var result = [];

      $vm.calcConfig.forEach(function (item) {
        title = 'Печать';

        if (item[0]) {
          title += $vm.getUpdateTitle('ламинация');
        }
        if (item[1]) {
          title += $vm.getUpdateTitle('высечка');
        }
        if (item[2]) {
          title += $vm.getUpdateTitle('монтажка');
        }

        result.push(title);
      });

      return result;
    },
    calcList() {
      return this.getCalculations();
    },
    calcListWithPercent() {
      return this.getCalculations(true);
    },
  },
  methods: {
    sizeWithReserve(size) {
      return size + 0.02;
    },
    getPercent(all, part) {
      return (all / 100) * part;
    },
    formatPrint(output) {
      // echo sprintf(title + ": %.2f", output);
      return output;
    },
    getUpdateTitle(name) {
      return ', ' + name;
    },
    getCalculation(isLamination, isDieCutting, isMontaging, toCalcPercent) {
      toCalcPercent = toCalcPercent || false;

      var title = 'Печать';
      var calcPrinting = this.pt;
      var calcPor = 0;
      var calcMM = 0;

      if (isLamination) {
        title += this.getUpdateTitle('ламинация');
        calcPrinting += this.lam;
      }
      if (isDieCutting) {
        title += this.getUpdateTitle('высечка');
        calcPor += this.por;
      }
      if (isMontaging) {
        title += this.getUpdateTitle('монтажка');
        calcMM += this.mm;
      }

      var result = this.kv * calcPrinting + calcPor + calcMM + this.pl;
      result *= this.s;

      if (toCalcPercent) {
        result += this.getPercent(result, this.percent);
      }

      return {
        title: title,
        value: this.formatPrint(result),
      };
    },
    getCalculations(toCalcPercent) {
      toCalcPercent = toCalcPercent || false;

      var $vm = this;
      var result = [];

      $vm.calcConfig.forEach(function (item) {
        result.push($vm.getCalculation(item[0], item[1], item[2], toCalcPercent));
      });

      return result;
    },
  },
});
