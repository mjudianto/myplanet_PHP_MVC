//  OnCLick Chart Visitor
function toggleBtn(evt, menuName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("chart-dashboard");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.transform = "scaleY(0.2)";
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" selected", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.className += " selected";
  setTimeout(() => {
    document.getElementById(menuName).style.transform = "scaleY(1)";
  }, 50);
}

$(document).ready(function () {
  $("#chartWeek").hide();
  $("#chartDay").hide();
});

window.onload = (event) => {
  document.getElementById("chartMonth").style.display = "block";
  document.getElementById("chartMonth").style.transform = "scaleY(1)";
};

// OnClick CHART E-LEARNING ---------------------------------------
function toggleBtn(evt, menuName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("chart-elearning");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.transform = "scaleY(0.2)";
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" selected", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.className += " selected";
  setTimeout(() => {
    document.getElementById(menuName).style.transform = "scaleY(1)";
  }, 50);
}

$(document).ready(function () {
  $("#chartQASecurity").hide();
  $("#chartTechnical").hide();
  $("#chartSoftSkill").hide();
});

window.onload = (event) => {
  document.getElementById("chartGeneral").style.display = "block";
  document.getElementById("chartGeneral").style.transform = "scaleY(1)";
};

// End OnClick CHART E-LEARNING ---------------------------------------

$(function () {
  "use strict";

  // chart1
  var options = {
    series: [
      {
        name: "Visitor",
        // data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5],
        data: [890, 689, 931, 821, 771, 901, 762, 816, 972, 879, 1021, 981],
      },
    ],
    chart: {
      foreColor: "#9a9797",
      type: "area",
      height: 380,
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: false,
        top: 3,
        left: 14,
        blur: 4,
        opacity: 0.1,
      },
    },
    stroke: {
      width: 4,
      curve: "smooth",
    },
    xaxis: {
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
    },
    dataLabels: {
      enabled: false,
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        gradientToColors: ["#8833ff"],
        shadeIntensity: 1,
        type: "vertical",
        opacityFrom: 0.8,
        opacityTo: 0.3,
        //stops: [0, 100, 100, 100]
      },
    },
    colors: ["#8833ff"],
    yaxis: {
      labels: {
        formatter: function (value) {
          return value;
        },
      },
    },
    markers: {
      size: 4,
      colors: ["#8833ff"],
      strokeColors: "#fff",
      strokeWidth: 2,
      hover: {
        size: 7,
      },
    },
    grid: {
      show: true,
      borderColor: "#ededed",
      strokeDashArray: 4,
    },
  };
  var chart = new ApexCharts(document.querySelector("#chartMonth"), options);
  chart.render();

  //   -----------------------------------------------------

  // chart Week
  var options = {
    series: [
      {
        name: "Visitor",
        // data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5],
        data: [785, 689, 542, 431],
      },
    ],
    chart: {
      foreColor: "#9a9797",
      type: "area",
      height: 380,
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: false,
        top: 3,
        left: 14,
        blur: 4,
        opacity: 0.1,
      },
    },
    stroke: {
      width: 4,
      curve: "smooth",
    },
    xaxis: {
      categories: ["Week 1", "Week 2", "Week 3", "Week 4"],
    },
    dataLabels: {
      enabled: false,
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        gradientToColors: ["#8833ff"],
        shadeIntensity: 1,
        type: "vertical",
        opacityFrom: 0.8,
        opacityTo: 0.3,
        //stops: [0, 100, 100, 100]
      },
    },
    colors: ["#8833ff"],
    yaxis: {
      labels: {
        formatter: function (value) {
          return value;
        },
      },
    },
    markers: {
      size: 4,
      colors: ["#8833ff"],
      strokeColors: "#fff",
      strokeWidth: 2,
      hover: {
        size: 7,
      },
    },
    grid: {
      show: true,
      borderColor: "#ededed",
      strokeDashArray: 4,
    },
  };
  var chart = new ApexCharts(document.querySelector("#chartWeek"), options);
  chart.render();

  //   -------------------------------------------------------------------------------------------------

  //   -----------------------------------------------------

  // chart Day
  var options = {
    series: [
      {
        name: "Visitor",
        // data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5],
        data: [785, 689, 542, 431, 254, 137, 122],
      },
    ],
    chart: {
      foreColor: "#9a9797",
      type: "area",
      height: 380,
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: false,
        top: 3,
        left: 14,
        blur: 4,
        opacity: 0.1,
      },
    },
    stroke: {
      width: 4,
      curve: "smooth",
    },
    xaxis: {
      categories: [
        "23 January 2023",
        "24 January 2023",
        "25 January 2023",
        "26 January 2023",
        "27 January 2023",
        "28 January 2023",
        "29 January 2023",
      ],
    },
    dataLabels: {
      enabled: false,
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        gradientToColors: ["#8833ff"],
        shadeIntensity: 1,
        type: "vertical",
        opacityFrom: 0.8,
        opacityTo: 0.3,
        //stops: [0, 100, 100, 100]
      },
    },
    colors: ["#8833ff"],
    yaxis: {
      labels: {
        formatter: function (value) {
          return value;
        },
      },
    },
    markers: {
      size: 4,
      colors: ["#8833ff"],
      strokeColors: "#fff",
      strokeWidth: 2,
      hover: {
        size: 7,
      },
    },
    grid: {
      show: true,
      borderColor: "#ededed",
      strokeDashArray: 4,
    },
  };
  var chart = new ApexCharts(document.querySelector("#chartDay"), options);
  chart.render();

  //   ---------------------------------------------------------------------------------------------

  // pie chart
  Highcharts.chart("piechart", {
    chart: {
      height: 350,
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: "pie",
      styledMode: true,
    },
    credits: {
      enabled: false,
    },
    title: {
      text: "Podtret",
    },
    subtitle: {
      text: "Ratio of podtret views by users",
    },
    tooltip: {
      pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
    },
    accessibility: {
      point: {
        valueSuffix: "%",
      },
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: "pointer",
        innerSize: 120,
        dataLabels: {
          enabled: true,
          format: "<b>{point.name}</b>: {point.percentage:.1f} %",
        },
        showInLegend: true,
      },
    },
    //colors: ['#ff9ad5', '#50b5ff', '#5a65dc'],
    series: [
      {
        name: "Views",
        colorByPoint: true,
        data: [
          {
            name: "Segment Ngobrol Santai",
            y: 56,
          },
          {
            name: "Segment Kumis",
            y: 30,
          },
          {
            name: "Segment Sapa Mantan",
            y: 14,
          },
        ],
      },
    ],
    responsive: {
      rules: [
        {
          condition: {
            maxWidth: 500,
          },
          chartOptions: {
            plotOptions: {
              pie: {
                innerSize: 140,
                dataLabels: {
                  enabled: false,
                },
              },
            },
          },
        },
      ],
    },
  });

  // Chart E-learning ------------------------------------------

  // Chart General
  Highcharts.chart("chartGeneral", {
    chart: {
      height: 360,
      type: "column",
      styledMode: true,
    },
    credits: {
      enabled: false,
    },
    title: {
      text: "E-learning",
    },
    subtitle: {
      text: "Records of General accessed by employees",
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      type: "category",
    },
    yAxis: {
      title: {
        text: "Total Access",
      },
    },
    legend: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: "{point.y}",
        },
      },
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Accessed<br/>',
    },
    series: [
      {
        name: "E-learning",
        colorByPoint: true,
        data: [
          {
            name: "NEOP GENERAL",
            y: 678,
            drilldown: "NEOP GENERAL",
          },
          {
            name: "NEOP WAREHOUSE",
            y: 234,
            drilldown: "NEOP WAREHOUSE",
          },
          {
            name: "NEOP TRANSPORTATION",
            y: 123,
            drilldown: "NEOP TRANSPORTATION",
          },
          {
            name: "INNO TALK",
            y: 276,
            drilldown: "INNO TALK",
          },
          {
            name: "Etika Bisnis 2022",
            y: 361,
            drilldown: "Etika Bisnis 2022",
          },
          {
            name: "Etika Bisnis : Pelanggaran",
            y: 156,
            drilldown: "Etika Bisnis : Pelanggaran",
          },
          {
            name: "E-court",
            y: 134,
            drilldown: "E-court",
          },
          {
            name: "Modul Fatigue",
            y: 362,
            drilldown: "Modul Fatigue",
          },
          {
            name: "Safety Security K3",
            y: 461,
            drilldown: "Safety Security K3",
          },
        ],
      },
    ],
  });

  // Chart QA & Security
  Highcharts.chart("chartQASecurity", {
    chart: {
      height: 360,
      type: "column",
      styledMode: true,
    },
    credits: {
      enabled: false,
    },
    title: {
      text: "E-learning",
    },
    subtitle: {
      text: "Records of QA & Security accessed by employees",
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      type: "category",
    },
    yAxis: {
      title: {
        text: "Total Access",
      },
    },
    legend: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: "{point.y}",
        },
      },
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Accessed<br/>',
    },
    series: [
      {
        name: "E-learning",
        colorByPoint: true,
        data: [
          {
            name: "CDOB 2020",
            y: 481,
            drilldown: "CDOB 2020",
          },
          {
            name: "CDAKB 2020",
            y: 123,
            drilldown: "CDAKB 2020",
          },
          {
            name: "Sertifikasi Halal",
            y: 253,
            drilldown: "Sertifikasi Halal",
          },
          {
            name: "Safety Security 2019",
            y: 415,
            drilldown: "Safety Security 2019",
          },
          {
            name: "IT Security 2021",
            y: 234,
            drilldown: "IT Security 2021",
          },
          {
            name: "Sosialisasi SOP & IK",
            y: 211,
            drilldown: "Sosialisasi SOP & IK",
          },
          {
            name: "IT Security Awareness : Email Phishing",
            y: 231,
            drilldown: "IT Security Awareness : Email Phishing",
          },
          {
            name: "Penanganan Produk Sitostatika",
            y: 421,
            drilldown: "Penanganan Produk Sitostatika",
          },
          {
            name: "General IT Security",
            y: 211,
            drilldown: "General IT Security",
          },
          {
            name: "Penggunaan APAR",
            y: 541,
            drilldown: "Penggunaan APAR",
          },
        ],
      },
    ],
  });

  // Chart Technical
  Highcharts.chart("chartTechnical", {
    chart: {
      height: 360,
      type: "column",
      styledMode: true,
    },
    credits: {
      enabled: false,
    },
    title: {
      text: "E-learning",
    },
    subtitle: {
      text: "Records of Technical accessed by employees",
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      type: "category",
    },
    yAxis: {
      title: {
        text: "Total Access",
      },
    },
    legend: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: "{point.y}",
        },
      },
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Accessed<br/>',
    },
    series: [
      {
        name: "E-learning",
        colorByPoint: true,
        data: [
          {
            name: "E-Warehouse",
            y: 342,
            drilldown: "E-Warehouse",
          },
          {
            name: "E-Transportation",
            y: 234,
            drilldown: "E-Transportation",
          },
          {
            name: "New Mindset Salesmanship",
            y: 342,
            drilldown: "New Mindset Salesmanship",
          },
          {
            name: "Storytelling With Data",
            y: 278,
            drilldown: "Storytelling With Data",
          },
        ],
      },
    ],
  });

  // Chart Soft Skill
  // Chart Technical
  Highcharts.chart("chartSoftSkill", {
    chart: {
      height: 360,
      type: "column",
      styledMode: true,
    },
    credits: {
      enabled: false,
    },
    title: {
      text: "E-learning",
    },
    subtitle: {
      text: "Records of Soft Skill accessed by employees",
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      type: "category",
    },
    yAxis: {
      title: {
        text: "Total Access",
      },
    },
    legend: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: "{point.y}",
        },
      },
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Accessed<br/>',
    },
    series: [
      {
        name: "E-learning",
        colorByPoint: true,
        data: [
          {
            name: "Operational Excellence",
            y: 421,
            drilldown: "Operational Excellence",
          },
          {
            name: "Leadership",
            y: 231,
            drilldown: "Leadership",
          },
          {
            name: "Communication & Human Relation",
            y: 312,
            drilldown: "Communication & Human Relation",
          },
          {
            name: "BEP: Catatan Si Bejo",
            y: 332,
            drilldown: "BEP: Catatan Si Bejo",
          },
          {
            name: "BEP: Catatan Si Bejo Eps.2",
            y: 350,
            drilldown: "BEP: Catatan Si Bejo Eps.2",
          },
          {
            name: "Finance & Accounting",
            y: 251,
            drilldown: "Finance & Accounting",
          },
          {
            name: "BEP: Catatan Si Bejo Eps.3",
            y: 312,
            drilldown: "BEP: Catatan Si Bejo Eps.3",
          },
        ],
      },
    ],
  });

  // End Chart E-learning --------------------------------------

  // Podtret Chart Vertical
  // Create the chart
  Highcharts.chart("verticalchartPodtret", {
    chart: {
      height: 360,
      type: "column",
      styledMode: true,
    },
    credits: {
      enabled: false,
    },
    title: {
      text: "PODTRET",
    },
    subtitle: {
      text: "Records of PODTRET Views",
    },
    accessibility: {
      announceNewData: {
        enabled: true,
      },
    },
    xAxis: {
      type: "category",
    },
    yAxis: {
      title: {
        text: "Total Views",
      },
    },
    legend: {
      enabled: false,
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: "{point.y}",
        },
      },
    },
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat:
        '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Views<br/>',
    },
    series: [
      {
        name: "PODTRET",
        colorByPoint: true,
        data: [
          {
            name: "Eps 39: Edisi Ibuck-Ibuck",
            y: 167,
            drilldown: "Eps 39: Edisi Ibuck-Ibuck",
          },
          {
            name: "Eps 40: Edisi Piala Dunia",
            y: 128,
            drilldown: "Eps 40: Edisi Piala Dunia",
          },
          {
            name: "Eps 41: Ritual Minta Darah",
            y: 291,
            drilldown: "Eps 41: Ritual Minta Darah",
          },
          {
            name: "Eps 42: Final Piala Dunia",
            y: 381,
            drilldown: "Eps 42: Final Piala Dunia",
          },
          {
            name: "Eps 43: Special Natal",
            y: 251,
            drilldown: "Eps 43: Special Natal",
          },
          {
            name: "Eps 44: Kilas Balik 2022",
            y: 172,
            drilldown: "Eps 44: Kilas Balik 2022",
          },
          {
            name: "Eps 45: Kuntilanak Numpang Mandi",
            y: 281,
            drilldown: "Eps 45: Kuntilanak Numpang Mandi",
          },
          {
            name: "Eps 46: Rumpi Yuk! Ngejulid bareng sekretaris",
            y: 176,
            drilldown: "Eps 46: Rumpi Yuk! Ngejulid bareng sekretaris",
          },
        ],
      },
    ],
  });
});
