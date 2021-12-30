chartLoader = {};
chartLoader.charts = {};
chartLoader.getAllAttributes = function (el) {
  var arr = {}, attrs = el.attributes, attr;
  for (i = 0;i < attrs.length;i++) {
    attr = attrs[i];
    arr[attr.nodeName] = attr.nodeValue;
  }
  return arr;
};
chartLoader.render = function () {
  var i, chart, chartAttrs, newChart, newChartEl, newChartId, newChartConfig;
  while (document.getElementsByTagName("chart")[0]) {
    chart = document.getElementsByTagName("chart")[0];
    if (chart.getAttribute('id') !== null) {
      chartAttrs = chartLoader.getAllAttributes(chart);
      newChartEl = document.createElement("canvas");
      newChartConfig = eval("("+chart.innerText+")");
      for (i = 0;i < Object.keys(chartAttrs).length;i++) {
        newChartEl.setAttribute(Object.keys(chartAttrs)[i], Object.values(chartAttrs)[i]);
      }
      newChartId = newChartEl.getAttribute('id');
      chart.parentNode.insertBefore(newChartEl, chart);
      chart.parentNode.removeChild(chart);
      newChart = new Chart(document.getElementById(newChartId).getContext('2d'), newChartConfig);
      chartLoader.charts[newChartId] = newChart;
    }
  }
};