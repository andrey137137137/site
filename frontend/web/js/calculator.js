new Vue({
  el: '#calculator',
  data: {
    course: 0,
    membrane: 0,
    montaging: 0,
    percent: 0,
    width: 0,
    height: 0,
    slicing: 0,
    cutting: 0,
    printing: 0,
    lamination: 0,
    outputData: [
      [0, 0],
      [1, 0],
      [0, 1],
      [1, 1],
    ],
  },
  computed: {
    quadrature() {
      return (
        this.sizeWithReserve(this.width) * this.sizeWithReserve(this.height)
      );
    },
    quadratureMembrane() {
      return this.quadrature * this.membrane;
    },
    plotter() {
      return this.slicing * this.cutting + this.quadratureMembrane;
    },
  },
  methods: {
    sizeWithReserve(size) {
      return size + 0.02;
    },
    getPercent(all, part) {
      return (all / 100) * part;
    },
    formatPrint(title, output) {
      // echo sprintf(title + ": %.2f", output);
    },
    printResult(isLamination, isDieCutting, toCalcPercent) {
      toCalcPercent = toCalcPercent || false;

      var title = 'Печать';
      var titleSeparator = ', ';
      var calcPrinting = this.printing;
      var caclPlotter = 0;

      if (isLamination) {
        title += titleSeparator + 'ламинация';
        calcPrinting += this.lamination;
      }
      if (isDieCutting) {
        title += titleSeparator + 'высечка';
        caclPlotter += this.plotter;
      }

      var result =
        this.quadrature * calcPrinting + caclPlotter + this.quadratureMembrane;
      result *= this.course;

      if (toCalcPercent) {
        result += this.getPercent(result, this.percent);
      }

      this.formatPrint(title, result);
    },
  },
  onSubmit() {
    var plotter = this.plotter * this.course;

    this.formatPrint('Плоттер', plotter);

    this.outputData.forEach(function (item) {
      this.printResult(item[0], item[1]);
    });

    // С процентами:
    this.formatPrint(
      'Плоттер',
      plotter + this.getPercent(plotter, this.percent),
    );

    this.outputData.forEach(function (item) {
      this.printResult(item[0], item[1], true);
    });
  },
  created() {
    console.log('Created');
  },
});
