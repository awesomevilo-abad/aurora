/*
 Highcharts JS v7.1.1 (2019-04-09)

 (c) 2009-2018 Torstein Honsi

 License: www.highcharts.com/license
*/
newFunction();

function newFunction() {
    (function (r) { "object" === typeof module && module.exports ? (r["default"] = r, module.exports = r) : "function" === typeof define && define.amd ? define("highcharts/highcharts-more", ["highcharts"], function (y) { r(y); r.Highcharts = y; return r; }) : r("undefined" !== typeof Highcharts ? Highcharts : void 0); })(function (r) {
        function y(a, p, l, e) { a.hasOwnProperty(p) || (a[p] = e.apply(null, l)); }
        r = r ? r._modules : {};
        y(r, "parts-more/Pane.js", [r["parts/Globals.js"]], function (a) {
            function p(b, f) { this.init(b, f); }
            var l = a.CenteredSeriesMixin, e = a.extend, h = a.merge, b = a.splat;
            e(p.prototype, {
            coll: "pane", init: function (b, f) { this.chart = f; this.background = []; f.pane.push(this); this.setOptions(b); }, setOptions: function (b) { this.options = h(this.defaultOptions, this.chart.angular ? { background: {} } : void 0, b); }, render: function () {
                var a = this.options, f = this.options.background, c = this.chart.renderer;
                this.group || (this.group = c.g("pane-group").attr({ zIndex: a.zIndex || 0 }).add());
                this.updateCenter();
                if (f)
                    for (f = b(f), a = Math.max(f.length, this.background.length || 0), c = 0; c < a; c++)
                        f[c] &&
                            this.axis ? this.renderBackground(h(this.defaultBackgroundOptions, f[c]), c) : this.background[c] && (this.background[c] = this.background[c].destroy(), this.background.splice(c, 1));
            }, renderBackground: function (b, f) {
                var c = "animate", a = { "class": "highcharts-pane " + (b.className || "") };
                this.chart.styledMode || e(a, { fill: b.backgroundColor, stroke: b.borderColor, "stroke-width": b.borderWidth });
                this.background[f] || (this.background[f] = this.chart.renderer.path().add(this.group), c = "attr");
                this.background[f][c]({ d: this.axis.getPlotBandPath(b.from, b.to, b) }).attr(a);
            }, defaultOptions: { center: ["50%", "50%"], size: "85%", startAngle: 0 }, defaultBackgroundOptions: { shape: "circle", borderWidth: 1, borderColor: "#cccccc", backgroundColor: { linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 }, stops: [[0, "#ffffff"], [1, "#e6e6e6"]] }, from: -Number.MAX_VALUE, innerRadius: 0, to: Number.MAX_VALUE, outerRadius: "105%" }, updateCenter: function (b) { this.center = (b || this.axis || {}).center = l.getCenter.call(this); }, update: function (b, f) {
                h(!0, this.options, b);
                h(!0, this.chart.options.pane, b);
                this.setOptions(this.options);
                this.render();
                this.chart.axes.forEach(function (b) { b.pane === this && (b.pane = null, b.update({}, f)); }, this);
            }
            });
            a.Pane = p;
        });
        y(r, "parts-more/RadialAxis.js", [r["parts/Globals.js"]], function (a) {
            var p = a.addEvent, l = a.Axis, e = a.extend, h = a.merge, b = a.noop, g = a.pick, f = a.pInt, c = a.Tick, t = a.wrap, w = a.correctFloat, x, d, q = l.prototype, n = c.prototype;
            x = { getOffset: b, redraw: function () { this.isDirty = !1; }, render: function () { this.isDirty = !1; }, setScale: b, setCategories: b, setTitle: b };
            d = {
            defaultRadialGaugeOptions: {
            labels: {
            align: "center", x: 0,
                y: null
            }, minorGridLineWidth: 0, minorTickInterval: "auto", minorTickLength: 10, minorTickPosition: "inside", minorTickWidth: 1, tickLength: 10, tickPosition: "inside", tickWidth: 2, title: { rotation: 0 }, zIndex: 2
            }, defaultRadialXOptions: { gridLineWidth: 1, labels: { align: null, distance: 15, x: 0, y: null, style: { textOverflow: "none" } }, maxPadding: 0, minPadding: 0, showLastLabel: !1, tickLength: 0 }, defaultRadialYOptions: { gridLineInterpolation: "circle", labels: { align: "right", x: -3, y: -2 }, showLastLabel: !1, title: { x: 4, text: null, rotation: 90 } }, setOptions: function (d) {
                d =
                    this.options = h(this.defaultOptions, this.defaultRadialOptions, d);
                d.plotBands || (d.plotBands = []);
                a.fireEvent(this, "afterSetOptions");
            }, getOffset: function () { q.getOffset.call(this); this.chart.axisOffset[this.side] = 0; }, getLinePath: function (d, b) {
                d = this.center;
                var k = this.chart, m = g(b, d[2] / 2 - this.offset);
                this.isCircular || void 0 !== b ? (b = this.chart.renderer.symbols.arc(this.left + d[0], this.top + d[1], m, m, { start: this.startAngleRad, end: this.endAngleRad, open: !0, innerR: 0 }), b.xBounds = [this.left + d[0]], b.yBounds = [this.top +
                    d[1] - m]) : (b = this.postTranslate(this.angleRad, m), b = ["M", d[0] + k.plotLeft, d[1] + k.plotTop, "L", b.x, b.y]);
                return b;
            }, setAxisTranslation: function () { q.setAxisTranslation.call(this); this.center && (this.transA = this.isCircular ? (this.endAngleRad - this.startAngleRad) / (this.max - this.min || 1) : this.center[2] / 2 / (this.max - this.min || 1), this.minPixelPadding = this.isXAxis ? this.transA * this.minPointOffset : 0); }, beforeSetTickPositions: function () {
                if (this.autoConnect = this.isCircular && void 0 === g(this.userMax, this.options.max) && w(this.endAngleRad -
                    this.startAngleRad) === w(2 * Math.PI))
                    this.max += this.categories && 1 || this.pointRange || this.closestPointRange || 0;
            }, setAxisSize: function () { q.setAxisSize.call(this); this.isRadial && (this.pane.updateCenter(this), this.isCircular && (this.sector = this.endAngleRad - this.startAngleRad), this.len = this.width = this.height = this.center[2] * g(this.sector, 1) / 2); }, getPosition: function (d, b) { return this.postTranslate(this.isCircular ? this.translate(d) : this.angleRad, g(this.isCircular ? b : this.translate(d), this.center[2] / 2) - this.offset); },
                postTranslate: function (d, b) { var k = this.chart, m = this.center; d = this.startAngleRad + d; return { x: k.plotLeft + m[0] + Math.cos(d) * b, y: k.plotTop + m[1] + Math.sin(d) * b }; }, getPlotBandPath: function (d, b, k) {
                    var m = this.center, q = this.startAngleRad, n = m[2] / 2, u = [g(k.outerRadius, "100%"), k.innerRadius, g(k.thickness, 10)], v = Math.min(this.offset, 0), c = /%$/, a, w;
                    a = this.isCircular;
                    "polygon" === this.options.gridLineInterpolation ? u = this.getPlotLinePath(d).concat(this.getPlotLinePath(b, !0)) : (d = Math.max(d, this.min), b = Math.min(b, this.max),
                        a || (u[0] = this.translate(d), u[1] = this.translate(b)), u = u.map(function (d) { c.test(d) && (d = f(d, 10) * n / 100); return d; }), "circle" !== k.shape && a ? (d = q + this.translate(d), b = q + this.translate(b)) : (d = -Math.PI / 2, b = 1.5 * Math.PI, w = !0), u[0] -= v, u[2] -= v, u = this.chart.renderer.symbols.arc(this.left + m[0], this.top + m[1], u[0], u[0], { start: Math.min(d, b), end: Math.max(d, b), innerR: g(u[1], u[0] - u[2]), open: w }), a && (a = (b + d) / 2, v = this.left + m[0] + m[2] / 2 * Math.cos(a), u.xBounds = a > -Math.PI / 2 && a < Math.PI / 2 ? [v, this.chart.plotWidth] : [0, v], u.yBounds =
                            [this.top + m[1] + m[2] / 2 * Math.sin(a)], u.yBounds[0] += a > -Math.PI && 0 > a || a > Math.PI ? -10 : 10));
                    return u;
                }, getPlotLinePath: function (d, b) {
                    var k = this, m = k.center, q = k.chart, n = k.getPosition(d), u, v, a;
                    k.isCircular ? a = ["M", m[0] + q.plotLeft, m[1] + q.plotTop, "L", n.x, n.y] : "circle" === k.options.gridLineInterpolation ? (d = k.translate(d), a = k.getLinePath(0, d)) : (q.xAxis.forEach(function (d) { d.pane === k.pane && (u = d); }), a = [], d = k.translate(d), m = u.tickPositions, u.autoConnect && (m = m.concat([m[0]])), b && (m = [].concat(m).reverse()), m.forEach(function (k, m) { v = u.getPosition(k, d); a.push(m ? "L" : "M", v.x, v.y); }));
                    return a;
                }, getTitlePosition: function () { var d = this.center, b = this.chart, k = this.options.title; return { x: b.plotLeft + d[0] + (k.x || 0), y: b.plotTop + d[1] - { high: .5, middle: .25, low: 0 }[k.align] * d[2] + (k.y || 0) }; }
            };
            p(l, "init", function (b) {
                var q = this, k = this.chart, m = k.angular, n = k.polar, u = this.isXAxis, a = m && u, c, f = k.options;
                b = b.userOptions.pane || 0;
                b = this.pane = k.pane && k.pane[b];
                if (m) {
                    if (e(this, a ? x : d), c = !u)
                        this.defaultRadialOptions = this.defaultRadialGaugeOptions;
                }
                else
                    n && (e(this, d), this.defaultRadialOptions = (c = u) ? this.defaultRadialXOptions : h(this.defaultYAxisOptions, this.defaultRadialYOptions));
                m || n ? (this.isRadial = !0, k.inverted = !1, f.chart.zoomType = null, k.labelCollectors.push(function () {
                if (q.isRadial && q.tickPositions && !0 !== q.options.labels.allowOverlap)
                    return q.tickPositions.map(function (d) { return q.ticks[d] && q.ticks[d].label; }).filter(function (d) { return !!d; });
                })) : this.isRadial = !1;
                b && c && (b.axis = this);
                this.isCircular = c;
            });
            p(l, "afterInit", function () {
                var d = this.chart, b = this.options, k = this.pane, m = k && k.options;
                d.angular && this.isXAxis || !k || !d.angular && !d.polar || (this.angleRad = (b.angle || 0) * Math.PI / 180, this.startAngleRad = (m.startAngle - 90) * Math.PI / 180, this.endAngleRad = (g(m.endAngle, m.startAngle + 360) - 90) * Math.PI / 180, this.offset = b.offset || 0);
            });
            p(l, "autoLabelAlign", function (d) { this.isRadial && (d.align = void 0, d.preventDefault()); });
            p(c, "afterGetPosition", function (d) { this.axis.getPosition && e(d.pos, this.axis.getPosition(this.pos)); });
            p(c, "afterGetLabelPosition", function (d) {
                var b = this.axis, k = this.label, m = b.options.labels, q = m.y, n, u = 20, a = m.align, c = (b.translate(this.pos) + b.startAngleRad + Math.PI / 2) / Math.PI * 180 % 360;
                b.isRadial && (n = b.getPosition(this.pos, b.center[2] / 2 + g(m.distance, -25)), "auto" === m.rotation ? k.attr({ rotation: c }) : null === q && (q = b.chart.renderer.fontMetrics(k.styles && k.styles.fontSize).b - k.getBBox().height / 2), null === a && (b.isCircular ? (this.label.getBBox().width > b.len * b.tickInterval / (b.max - b.min) && (u = 0), a = c > u && c < 180 - u ? "left" : c > 180 + u && c < 360 - u ? "right" : "center") : a = "center", k.attr({ align: a })),
                    d.pos.x = n.x + m.x, d.pos.y = n.y + q);
            });
            t(n, "getMarkPath", function (d, b, k, m, q, n, a) { var u = this.axis; u.isRadial ? (d = u.getPosition(this.pos, u.center[2] / 2 + m), b = ["M", b, k, "L", d.x, d.y]) : b = d.call(this, b, k, m, q, n, a); return b; });
        });
        y(r, "parts-more/AreaRangeSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.pick, l = a.extend, e = a.isArray, h = a.defined, b = a.seriesType, g = a.seriesTypes, f = a.Series.prototype, c = a.Point.prototype;
            b("arearange", "area", {
            lineWidth: 1, threshold: null, tooltip: { pointFormat: '\x3cspan style\x3d"color:{series.color}"\x3e\u25cf\x3c/span\x3e {series.name}: \x3cb\x3e{point.low}\x3c/b\x3e - \x3cb\x3e{point.high}\x3c/b\x3e\x3cbr/\x3e' },
                trackByArea: !0, dataLabels: { align: null, verticalAlign: null, xLow: 0, xHigh: 0, yLow: 0, yHigh: 0 }
            }, {
            pointArrayMap: ["low", "high"], toYData: function (b) { return [b.low, b.high]; }, pointValKey: "low", deferTranslatePolar: !0, highToXY: function (b) { var a = this.chart, c = this.xAxis.postTranslate(b.rectPlotX, this.yAxis.len - b.plotHigh); b.plotHighX = c.x - a.plotLeft; b.plotHigh = c.y - a.plotTop; b.plotLowX = b.plotX; }, translate: function () {
                var b = this, a = b.yAxis, c = !!b.modifyValue;
                g.area.prototype.translate.apply(b);
                b.points.forEach(function (d) {
                    var q = d.low, n = d.high, u = d.plotY;
                    null === n || null === q ? (d.isNull = !0, d.plotY = null) : (d.plotLow = u, d.plotHigh = a.translate(c ? b.modifyValue(n, d) : n, 0, 1, 0, 1), c && (d.yBottom = d.plotHigh));
                });
                this.chart.polar && this.points.forEach(function (d) { b.highToXY(d); d.tooltipPos = [(d.plotHighX + d.plotLowX) / 2, (d.plotHigh + d.plotLow) / 2]; });
            }, getGraphPath: function (b) {
                var a = [], c = [], d, q = g.area.prototype.getGraphPath, n, u, v;
                v = this.options;
                var k = this.chart.polar && !1 !== v.connectEnds, m = v.connectNulls, f = v.step;
                b = b || this.points;
                for (d = b.length; d--;)
                    n =
                        b[d], n.isNull || k || m || b[d + 1] && !b[d + 1].isNull || c.push({ plotX: n.plotX, plotY: n.plotY, doCurve: !1 }), u = { polarPlotY: n.polarPlotY, rectPlotX: n.rectPlotX, yBottom: n.yBottom, plotX: p(n.plotHighX, n.plotX), plotY: n.plotHigh, isNull: n.isNull }, c.push(u), a.push(u), n.isNull || k || m || b[d - 1] && !b[d - 1].isNull || c.push({ plotX: n.plotX, plotY: n.plotY, doCurve: !1 });
                b = q.call(this, b);
                f && (!0 === f && (f = "left"), v.step = { left: "right", center: "center", right: "left" }[f]);
                a = q.call(this, a);
                c = q.call(this, c);
                v.step = f;
                v = [].concat(b, a);
                this.chart.polar ||
                    "M" !== c[0] || (c[0] = "L");
                this.graphPath = v;
                this.areaPath = b.concat(c);
                v.isArea = !0;
                v.xMap = b.xMap;
                this.areaPath.xMap = b.xMap;
                return v;
            }, drawDataLabels: function () {
                var b = this.points, a = b.length, c, d = [], q = this.options.dataLabels, n, u, v = this.chart.inverted, k, m;
                e(q) ? 1 < q.length ? (k = q[0], m = q[1]) : (k = q[0], m = { enabled: !1 }) : (k = l({}, q), k.x = q.xHigh, k.y = q.yHigh, m = l({}, q), m.x = q.xLow, m.y = q.yLow);
                if (k.enabled || this._hasPointLabels) {
                    for (c = a; c--;)
                        if (n = b[c])
                            u = k.inside ? n.plotHigh < n.plotLow : n.plotHigh > n.plotLow, n.y = n.high, n._plotY =
                                n.plotY, n.plotY = n.plotHigh, d[c] = n.dataLabel, n.dataLabel = n.dataLabelUpper, n.below = u, v ? k.align || (k.align = u ? "right" : "left") : k.verticalAlign || (k.verticalAlign = u ? "top" : "bottom");
                    this.options.dataLabels = k;
                    f.drawDataLabels && f.drawDataLabels.apply(this, arguments);
                    for (c = a; c--;)
                        if (n = b[c])
                            n.dataLabelUpper = n.dataLabel, n.dataLabel = d[c], delete n.dataLabels, n.y = n.low, n.plotY = n._plotY;
                }
                if (m.enabled || this._hasPointLabels) {
                    for (c = a; c--;)
                        if (n = b[c])
                            u = m.inside ? n.plotHigh < n.plotLow : n.plotHigh > n.plotLow, n.below = !u, v ? m.align ||
                                (m.align = u ? "left" : "right") : m.verticalAlign || (m.verticalAlign = u ? "bottom" : "top");
                    this.options.dataLabels = m;
                    f.drawDataLabels && f.drawDataLabels.apply(this, arguments);
                }
                if (k.enabled)
                    for (c = a; c--;)
                        if (n = b[c])
                            n.dataLabels = [n.dataLabelUpper, n.dataLabel].filter(function (d) { return !!d; });
                this.options.dataLabels = q;
            }, alignDataLabel: function () { g.column.prototype.alignDataLabel.apply(this, arguments); }, drawPoints: function () {
                var b = this.points.length, c, e;
                f.drawPoints.apply(this, arguments);
                for (e = 0; e < b;)
                    c = this.points[e], c.origProps =
                        { plotY: c.plotY, plotX: c.plotX, isInside: c.isInside, negative: c.negative, zone: c.zone, y: c.y }, c.lowerGraphic = c.graphic, c.graphic = c.upperGraphic, c.plotY = c.plotHigh, h(c.plotHighX) && (c.plotX = c.plotHighX), c.y = c.high, c.negative = c.high < (this.options.threshold || 0), c.zone = this.zones.length && c.getZone(), this.chart.polar || (c.isInside = c.isTopInside = void 0 !== c.plotY && 0 <= c.plotY && c.plotY <= this.yAxis.len && 0 <= c.plotX && c.plotX <= this.xAxis.len), e++;
                f.drawPoints.apply(this, arguments);
                for (e = 0; e < b;)
                    c = this.points[e], c.upperGraphic =
                        c.graphic, c.graphic = c.lowerGraphic, a.extend(c, c.origProps), delete c.origProps, e++;
            }, setStackedPoints: a.noop
                }, {
                setState: function () {
                    var b = this.state, a = this.series, f = a.chart.polar;
                    h(this.plotHigh) || (this.plotHigh = a.yAxis.toPixels(this.high, !0));
                    h(this.plotLow) || (this.plotLow = this.plotY = a.yAxis.toPixels(this.low, !0));
                    a.stateMarkerGraphic && (a.lowerStateMarkerGraphic = a.stateMarkerGraphic, a.stateMarkerGraphic = a.upperStateMarkerGraphic);
                    this.graphic = this.upperGraphic;
                    this.plotY = this.plotHigh;
                    f && (this.plotX =
                        this.plotHighX);
                    c.setState.apply(this, arguments);
                    this.state = b;
                    this.plotY = this.plotLow;
                    this.graphic = this.lowerGraphic;
                    f && (this.plotX = this.plotLowX);
                    a.stateMarkerGraphic && (a.upperStateMarkerGraphic = a.stateMarkerGraphic, a.stateMarkerGraphic = a.lowerStateMarkerGraphic, a.lowerStateMarkerGraphic = void 0);
                    c.setState.apply(this, arguments);
                }, haloPath: function () {
                    var b = this.series.chart.polar, a = [];
                    this.plotY = this.plotLow;
                    b && (this.plotX = this.plotLowX);
                    this.isInside && (a = c.haloPath.apply(this, arguments));
                    this.plotY =
                        this.plotHigh;
                    b && (this.plotX = this.plotHighX);
                    this.isTopInside && (a = a.concat(c.haloPath.apply(this, arguments)));
                    return a;
                }, destroyElements: function () { ["lowerGraphic", "upperGraphic"].forEach(function (b) { this[b] && (this[b] = this[b].destroy()); }, this); this.graphic = null; return c.destroyElements.apply(this, arguments); }
                });
        });
        y(r, "parts-more/AreaSplineRangeSeries.js", [r["parts/Globals.js"]], function (a) { var p = a.seriesType; p("areasplinerange", "arearange", null, { getPointSpline: a.seriesTypes.spline.prototype.getPointSpline }); });
        y(r, "parts-more/ColumnRangeSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.defaultPlotOptions, l = a.merge, e = a.noop, h = a.pick, b = a.seriesType, g = a.seriesTypes.column.prototype;
            b("columnrange", "arearange", l(p.column, p.arearange, { pointRange: null, marker: null, states: { hover: { halo: !1 } } }), {
            translate: function () {
                var b = this, c = b.yAxis, a = b.xAxis, e = a.startAngleRad, p, d = b.chart, q = b.xAxis.isRadial, n = Math.max(d.chartWidth, d.chartHeight) + 999, u;
                g.translate.apply(b);
                b.points.forEach(function (v) {
                    var k = v.shapeArgs, m = b.options.minPointLength, f, g;
                    v.plotHigh = u = Math.min(Math.max(-n, c.translate(v.high, 0, 1, 0, 1)), n);
                    v.plotLow = Math.min(Math.max(-n, v.plotY), n);
                    g = u;
                    f = h(v.rectPlotY, v.plotY) - u;
                    Math.abs(f) < m ? (m -= f, f += m, g -= m / 2) : 0 > f && (f *= -1, g -= f);
                    q ? (p = v.barX + e, v.shapeType = "path", v.shapeArgs = { d: b.polarArc(g + f, g, p, p + v.pointWidth) }) : (k.height = f, k.y = g, v.tooltipPos = d.inverted ? [c.len + c.pos - d.plotLeft - g - f / 2, a.len + a.pos - d.plotTop - k.x - k.width / 2, f] : [a.left - d.plotLeft + k.x + k.width / 2, c.pos - d.plotTop + g + f / 2, f]);
                });
            }, directTouch: !0, trackerGroups: ["group",
                "dataLabelsGroup"], drawGraph: e, getSymbol: e, crispCol: function () { return g.crispCol.apply(this, arguments); }, drawPoints: function () { return g.drawPoints.apply(this, arguments); }, drawTracker: function () { return g.drawTracker.apply(this, arguments); }, getColumnMetrics: function () { return g.getColumnMetrics.apply(this, arguments); }, pointAttribs: function () { return g.pointAttribs.apply(this, arguments); }, animate: function () { return g.animate.apply(this, arguments); }, polarArc: function () { return g.polarArc.apply(this, arguments); },
                translate3dPoints: function () { return g.translate3dPoints.apply(this, arguments); }, translate3dShapes: function () { return g.translate3dShapes.apply(this, arguments); }
            }, { setState: g.pointClass.prototype.setState });
        });
        y(r, "parts-more/ColumnPyramidSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.pick, l = a.seriesType, e = a.seriesTypes.column.prototype;
            l("columnpyramid", "column", {}, {
            translate: function () {
                var a = this, b = a.chart, g = a.options, f = a.dense = 2 > a.closestPointRange * a.xAxis.transA, f = a.borderWidth = p(g.borderWidth, f ? 0 : 1), c = a.yAxis, l = g.threshold, w = a.translatedThreshold = c.getThreshold(l), x = p(g.minPointLength, 5), d = a.getColumnMetrics(), q = d.width, n = a.barW = Math.max(q, 1 + 2 * f), u = a.pointXOffset = d.offset;
                b.inverted && (w -= .5);
                g.pointPadding && (n = Math.ceil(n));
                e.translate.apply(a);
                a.points.forEach(function (d) {
                    var k = p(d.yBottom, w), m = 999 + Math.abs(k), f = Math.min(Math.max(-m, d.plotY), c.len + m), m = d.plotX + u, e = n / 2, v = Math.min(f, k), k = Math.max(f, k) - v, h, B, t, z, r, C;
                    d.barX = m;
                    d.pointWidth = q;
                    d.tooltipPos = b.inverted ? [c.len + c.pos - b.plotLeft -
                        f, a.xAxis.len - m - e, k] : [m + e, f + c.pos - b.plotTop, k];
                    f = l + (d.total || d.y);
                    "percent" === g.stacking && (f = l + (0 > d.y) ? -100 : 100);
                    f = c.toPixels(f, !0);
                    h = b.plotHeight - f - (b.plotHeight - w);
                    B = e * (v - f) / h;
                    t = e * (v + k - f) / h;
                    h = m - B + e;
                    B = m + B + e;
                    z = m + t + e;
                    t = m - t + e;
                    r = v - x;
                    C = v + k;
                    0 > d.y && (r = v, C = v + k + x);
                    b.inverted && (z = b.plotWidth - v, h = f - (b.plotWidth - w), B = e * (f - z) / h, t = e * (f - (z - k)) / h, h = m + e + B, B = h - 2 * B, z = m - t + e, t = m + t + e, r = v, C = v + k - x, 0 > d.y && (C = v + k + x));
                    d.shapeType = "path";
                    d.shapeArgs = { x: h, y: r, width: B - h, height: k, d: ["M", h, r, "L", B, r, z, C, t, C, "Z"] };
                });
            }
            });
        });
        y(r, "parts-more/GaugeSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.isNumber, l = a.merge, e = a.pick, h = a.pInt, b = a.Series, g = a.seriesType, f = a.TrackerMixin;
            g("gauge", "line", { dataLabels: { borderColor: "#cccccc", borderRadius: 3, borderWidth: 1, crop: !1, defer: !1, enabled: !0, verticalAlign: "top", y: 15, zIndex: 2 }, dial: {}, pivot: {}, tooltip: { headerFormat: "" }, showInLegend: !1 }, {
            angular: !0, directTouch: !0, drawGraph: a.noop, fixedBox: !0, forceDL: !0, noSharedTooltip: !0, trackerGroups: ["group", "dataLabelsGroup"], translate: function () {
                var b = this.yAxis, a = this.options, f = b.center;
                this.generatePoints();
                this.points.forEach(function (c) {
                    var d = l(a.dial, c.dial), q = h(e(d.radius, 80)) * f[2] / 200, n = h(e(d.baseLength, 70)) * q / 100, u = h(e(d.rearLength, 10)) * q / 100, v = d.baseWidth || 3, k = d.topWidth || 1, m = a.overshoot, g = b.startAngleRad + b.translate(c.y, null, null, null, !0);
                    p(m) ? (m = m / 180 * Math.PI, g = Math.max(b.startAngleRad - m, Math.min(b.endAngleRad + m, g))) : !1 === a.wrap && (g = Math.max(b.startAngleRad, Math.min(b.endAngleRad, g)));
                    g = 180 * g / Math.PI;
                    c.shapeType = "path";
                    c.shapeArgs = {
                    d: d.path || ["M", -u, -v / 2, "L",
                        n, -v / 2, q, -k / 2, q, k / 2, n, v / 2, -u, v / 2, "z"], translateX: f[0], translateY: f[1], rotation: g
                    };
                    c.plotX = f[0];
                    c.plotY = f[1];
                });
            }, drawPoints: function () {
                var b = this, a = b.chart, f = b.yAxis.center, g = b.pivot, d = b.options, q = d.pivot, n = a.renderer;
                b.points.forEach(function (q) {
                    var c = q.graphic, k = q.shapeArgs, m = k.d, f = l(d.dial, q.dial);
                    c ? (c.animate(k), k.d = m) : (q.graphic = n[q.shapeType](k).attr({ rotation: k.rotation, zIndex: 1 }).addClass("highcharts-dial").add(b.group), a.styledMode || q.graphic.attr({
                    stroke: f.borderColor || "none", "stroke-width": f.borderWidth ||
                        0, fill: f.backgroundColor || "#000000"
                    }));
                });
                g ? g.animate({ translateX: f[0], translateY: f[1] }) : (b.pivot = n.circle(0, 0, e(q.radius, 5)).attr({ zIndex: 2 }).addClass("highcharts-pivot").translate(f[0], f[1]).add(b.group), a.styledMode || b.pivot.attr({ "stroke-width": q.borderWidth || 0, stroke: q.borderColor || "#cccccc", fill: q.backgroundColor || "#000000" }));
            }, animate: function (b) {
                var a = this;
                b || (a.points.forEach(function (b) {
                    var c = b.graphic;
                    c && (c.attr({ rotation: 180 * a.yAxis.startAngleRad / Math.PI }), c.animate({ rotation: b.shapeArgs.rotation }, a.options.animation));
                }), a.animate = null);
            }, render: function () { this.group = this.plotGroup("group", "series", this.visible ? "visible" : "hidden", this.options.zIndex, this.chart.seriesGroup); b.prototype.render.call(this); this.group.clip(this.chart.clipRect); }, setData: function (a, f) { b.prototype.setData.call(this, a, !1); this.processData(); this.generatePoints(); e(f, !0) && this.chart.redraw(); }, hasData: function () { return !!this.points.length; }, drawTracker: f && f.drawTrackerPoint
            }, { setState: function (b) { this.state = b; } });
        });
        y(r, "parts-more/BoxPlotSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.noop, l = a.pick, e = a.seriesType, h = a.seriesTypes;
            e("boxplot", "column", {
            threshold: null, tooltip: { pointFormat: '\x3cspan style\x3d"color:{point.color}"\x3e\u25cf\x3c/span\x3e \x3cb\x3e {series.name}\x3c/b\x3e\x3cbr/\x3eMaximum: {point.high}\x3cbr/\x3eUpper quartile: {point.q3}\x3cbr/\x3eMedian: {point.median}\x3cbr/\x3eLower quartile: {point.q1}\x3cbr/\x3eMinimum: {point.low}\x3cbr/\x3e' }, whiskerLength: "50%", fillColor: "#ffffff", lineWidth: 1,
                medianWidth: 2, whiskerWidth: 2
            }, {
            pointArrayMap: ["low", "q1", "median", "q3", "high"], toYData: function (b) { return [b.low, b.q1, b.median, b.q3, b.high]; }, pointValKey: "high", pointAttribs: function () { return {}; }, drawDataLabels: p, translate: function () { var b = this.yAxis, a = this.pointArrayMap; h.column.prototype.translate.apply(this); this.points.forEach(function (f) { a.forEach(function (a) { null !== f[a] && (f[a + "Plot"] = b.translate(f[a], 0, 1, 0, 1)); }); }); }, drawPoints: function () {
                var b = this, a = b.options, f = b.chart, c = f.renderer, e, h, p, d, q, n, u = 0, v, k, m, I, E = !1 !== b.doQuartiles, F, D = b.options.whiskerLength;
                b.points.forEach(function (g) {
                    var t = g.graphic, B = t ? "animate" : "attr", w = g.shapeArgs, x = {}, r = {}, A = {}, y = {}, G = g.color || b.color;
                    void 0 !== g.plotY && (v = w.width, k = Math.floor(w.x), m = k + v, I = Math.round(v / 2), e = Math.floor(E ? g.q1Plot : g.lowPlot), h = Math.floor(E ? g.q3Plot : g.lowPlot), p = Math.floor(g.highPlot), d = Math.floor(g.lowPlot), t || (g.graphic = t = c.g("point").add(b.group), g.stem = c.path().addClass("highcharts-boxplot-stem").add(t), D && (g.whiskers = c.path().addClass("highcharts-boxplot-whisker").add(t)),
                        E && (g.box = c.path(void 0).addClass("highcharts-boxplot-box").add(t)), g.medianShape = c.path(void 0).addClass("highcharts-boxplot-median").add(t)), f.styledMode || (r.stroke = g.stemColor || a.stemColor || G, r["stroke-width"] = l(g.stemWidth, a.stemWidth, a.lineWidth), r.dashstyle = g.stemDashStyle || a.stemDashStyle, g.stem.attr(r), D && (A.stroke = g.whiskerColor || a.whiskerColor || G, A["stroke-width"] = l(g.whiskerWidth, a.whiskerWidth, a.lineWidth), g.whiskers.attr(A)), E && (x.fill = g.fillColor || a.fillColor || G, x.stroke = a.lineColor ||
                            G, x["stroke-width"] = a.lineWidth || 0, g.box.attr(x)), y.stroke = g.medianColor || a.medianColor || G, y["stroke-width"] = l(g.medianWidth, a.medianWidth, a.lineWidth), g.medianShape.attr(y)), n = g.stem.strokeWidth() % 2 / 2, u = k + I + n, g.stem[B]({ d: ["M", u, h, "L", u, p, "M", u, e, "L", u, d] }), E && (n = g.box.strokeWidth() % 2 / 2, e = Math.floor(e) + n, h = Math.floor(h) + n, k += n, m += n, g.box[B]({ d: ["M", k, h, "L", k, e, "L", m, e, "L", m, h, "L", k, h, "z"] })), D && (n = g.whiskers.strokeWidth() % 2 / 2, p += n, d += n, F = /%$/.test(D) ? I * parseFloat(D) / 100 : D / 2, g.whiskers[B]({
                            d: ["M",
                                u - F, p, "L", u + F, p, "M", u - F, d, "L", u + F, d]
                            })), q = Math.round(g.medianPlot), n = g.medianShape.strokeWidth() % 2 / 2, q += n, g.medianShape[B]({ d: ["M", k, q, "L", m, q] }));
                });
            }, setStackedPoints: p
                });
        });
        y(r, "parts-more/ErrorBarSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.noop, l = a.seriesType, e = a.seriesTypes;
            l("errorbar", "boxplot", {
            color: "#000000", grouping: !1, linkedTo: ":previous", tooltip: { pointFormat: '\x3cspan style\x3d"color:{point.color}"\x3e\u25cf\x3c/span\x3e {series.name}: \x3cb\x3e{point.low}\x3c/b\x3e - \x3cb\x3e{point.high}\x3c/b\x3e\x3cbr/\x3e' },
                whiskerWidth: null
            }, { type: "errorbar", pointArrayMap: ["low", "high"], toYData: function (a) { return [a.low, a.high]; }, pointValKey: "high", doQuartiles: !1, drawDataLabels: e.arearange ? function () { var a = this.pointValKey; e.arearange.prototype.drawDataLabels.call(this); this.data.forEach(function (b) { b.y = b[a]; }); } : p, getColumnMetrics: function () { return this.linkedParent && this.linkedParent.columnMetrics || e.column.prototype.getColumnMetrics.call(this); } });
        });
        y(r, "parts-more/WaterfallSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.correctFloat, l = a.isNumber, e = a.pick, h = a.objectEach, b = a.arrayMin, g = a.arrayMax, f = a.addEvent, c = a.Chart, t = a.Point, w = a.Series, x = a.seriesType, d = a.seriesTypes;
            f(a.Axis, "afterInit", function () { this.isXAxis || (this.waterfallStacks = {}); });
            f(c, "beforeRedraw", function () {
            for (var b = this.axes, d = this.series, a = d.length; a--;)
                d[a].options.stacking && (b.forEach(function (b) { b.isXAxis || (b.waterfallStacks = {}); }), a = 0);
            });
            x("waterfall", "column", {
            dataLabels: { inside: !0 }, lineWidth: 1, lineColor: "#333333", dashStyle: "Dot", borderColor: "#333333",
                states: { hover: { lineWidthPlus: 0 } }
            }, {
            pointValKey: "y", showLine: !0, generatePoints: function () {
            var b, a, c, f; d.column.prototype.generatePoints.apply(this); c = 0; for (a = this.points.length; c < a; c++)
                if (b = this.points[c], f = this.processedYData[c], b.isIntermediateSum || b.isSum)
                    b.y = p(f);
            }, translate: function () {
                var b = this.options, a = this.yAxis, c, f, k, m, g, h, p, l, t, w = e(b.minPointLength, 5), x = w / 2, r = b.threshold, C = b.stacking, J = a.waterfallStacks[this.stackKey], A;
                d.column.prototype.translate.apply(this);
                p = l = r;
                f = this.points;
                c = 0;
                for (b =
                    f.length; c < b; c++)
                    k = f[c], h = this.processedYData[c], m = k.shapeArgs, t = [0, h], A = k.y, C ? J && (t = J[c], "overlap" === C ? (g = t.threshold + t.total, t.total -= A, g = 0 <= A ? g : g - A) : 0 <= A ? (g = t.threshold + t.posTotal, t.posTotal -= A) : (g = t.threshold + t.negTotal, t.negTotal -= A, g -= A), k.isSum || (t.connectorThreshold = t.threshold + t.stackTotal), a.reversed ? (h = 0 <= A ? g - A : g + A, A = g) : (h = g, A = g - A), k.below = h <= e(r, 0), m.y = a.translate(h, 0, 1, 0, 1), m.height = Math.abs(m.y - a.translate(A, 0, 1, 0, 1))) : (g = Math.max(p, p + A) + t[0], m.y = a.translate(g, 0, 1, 0, 1), k.isSum ? (m.y =
                        a.translate(t[1], 0, 1, 0, 1), m.height = Math.min(a.translate(t[0], 0, 1, 0, 1), a.len) - m.y) : k.isIntermediateSum ? (0 <= A ? (h = t[1] + l, A = l) : (h = l, A = t[1] + l), a.reversed && (h ^= A, A ^= h, h ^= A), m.y = a.translate(h, 0, 1, 0, 1), m.height = Math.abs(m.y - Math.min(a.translate(A, 0, 1, 0, 1), a.len)), l += t[1]) : (m.height = 0 < h ? a.translate(p, 0, 1, 0, 1) - m.y : a.translate(p, 0, 1, 0, 1) - a.translate(p - h, 0, 1, 0, 1), p += h, k.below = p < e(r, 0)), 0 > m.height && (m.y += m.height, m.height *= -1)), k.plotY = m.y = Math.round(m.y) - this.borderWidth % 2 / 2, m.height = Math.max(Math.round(m.height), .001), k.yBottom = m.y + m.height, m.height <= w && !k.isNull ? (m.height = w, m.y -= x, k.plotY = m.y, k.minPointLengthOffset = 0 > k.y ? -x : x) : (k.isNull && (m.width = 0), k.minPointLengthOffset = 0), m = k.plotY + (k.negative ? m.height : 0), this.chart.inverted ? k.tooltipPos[0] = a.len - m : k.tooltipPos[1] = m;
            }, processData: function (b) {
                var d = this.options, a = this.yData, c = d.data, k, m = a.length, q = d.threshold || 0, f, g, e, h, t, l;
                for (l = g = f = e = h = 0; l < m; l++)
                    t = a[l], k = c && c[l] ? c[l] : {}, "sum" === t || k.isSum ? a[l] = p(g) : "intermediateSum" === t || k.isIntermediateSum ? (a[l] = p(f),
                        f = 0) : (g += t, f += t), e = Math.min(g, e), h = Math.max(g, h);
                w.prototype.processData.call(this, b);
                d.stacking || (this.dataMin = e + q, this.dataMax = h);
            }, toYData: function (b) { return b.isSum ? 0 === b.x ? null : "sum" : b.isIntermediateSum ? 0 === b.x ? null : "intermediateSum" : b.y; }, pointAttribs: function (b, a) { var c = this.options.upColor; c && !b.options.color && (b.color = 0 < b.y ? c : null); b = d.column.prototype.pointAttribs.call(this, b, a); delete b.dashstyle; return b; }, getGraphPath: function () { return ["M", 0, 0]; }, getCrispPath: function () {
                var b = this.data, d = this.yAxis, a = b.length, c = Math.round(this.graph.strokeWidth()) % 2 / 2, k = Math.round(this.borderWidth) % 2 / 2, m = this.xAxis.reversed, f = this.yAxis.reversed, g = this.options.stacking, e = [], h, p, l, t, w, x, r;
                for (x = 1; x < a; x++) {
                    w = b[x].shapeArgs;
                    p = b[x - 1];
                    t = b[x - 1].shapeArgs;
                    h = d.waterfallStacks[this.stackKey];
                    l = 0 < p.y ? -t.height : 0;
                    h && (h = h[x - 1], g ? (h = h.connectorThreshold, l = Math.round(d.translate(h, 0, 1, 0, 1) + (f ? l : 0)) - c) : l = t.y + p.minPointLengthOffset + k - c, r = ["M", t.x + (m ? 0 : t.width), l, "L", w.x + (m ? w.width : 0), l]);
                    if (!g && 0 > p.y && !f || 0 < p.y &&
                        f)
                        r[2] += t.height, r[5] += t.height;
                    e = e.concat(r);
                }
                return e;
            }, drawGraph: function () { w.prototype.drawGraph.call(this); this.graph.attr({ d: this.getCrispPath() }); }, setStackedPoints: function () {
                var b = this.options, d = this.yAxis.waterfallStacks, a = b.threshold, c = a || 0, k = a || 0, m = this.stackKey, f = this.xData, g = f.length, e, h, p, l;
                if (this.visible || !this.chart.options.chart.ignoreHiddenSeries)
                    for (d[m] || (d[m] = {}), d = d[m], m = 0; m < g; m++)
                        e = f[m], d[e] || (d[e] = { negTotal: 0, posTotal: 0, total: 0, stackTotal: 0, threshold: 0, stackState: [c] }), e = d[e],
                            h = this.yData[m], 0 <= h ? e.posTotal += h : e.negTotal += h, l = b.data[m], h = e.posTotal, p = e.negTotal, l && l.isIntermediateSum ? (c ^= k, k ^= c, c ^= k) : l && l.isSum && (c = a), e.stackTotal = h + p, e.total = e.stackTotal, e.threshold = c, e.stackState[0] = c, e.stackState.push(e.stackTotal), c += e.stackTotal;
            }, getExtremes: function () {
                var d = this.options.stacking, a, c, f, k, m;
                d && (a = this.yAxis, a = a.waterfallStacks, c = this.stackedYNeg = [], f = this.stackedYPos = [], "overlap" === d ? h(a[this.stackKey], function (d) {
                    k = [];
                    d.stackState.forEach(function (b, a) {
                        m = d.stackState[0];
                        a ? k.push(b + m) : k.push(m);
                    });
                    c.push(b(k));
                    f.push(g(k));
                }) : h(a[this.stackKey], function (b) { c.push(b.negTotal + b.threshold); f.push(b.posTotal + b.threshold); }), this.dataMin = b(c), this.dataMax = g(f));
            }
                }, { getClassName: function () { var b = t.prototype.getClassName.call(this); this.isSum ? b += " highcharts-sum" : this.isIntermediateSum && (b += " highcharts-intermediate-sum"); return b; }, isValid: function () { return l(this.y, !0) || this.isSum || this.isIntermediateSum; } });
        });
        y(r, "parts-more/PolygonSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.Series, l = a.seriesType, e = a.seriesTypes;
            l("polygon", "scatter", { marker: { enabled: !1, states: { hover: { enabled: !1 } } }, stickyTracking: !1, tooltip: { followPointer: !0, pointFormat: "" }, trackByArea: !0 }, {
            type: "polygon", getGraphPath: function () {
            for (var a = p.prototype.getGraphPath.call(this), b = a.length + 1; b--;)
                (b === a.length || "M" === a[b]) && 0 < b && a.splice(b, 0, "z"); return this.areaPath = a;
            }, drawGraph: function () { this.options.fillColor = this.color; e.area.prototype.drawGraph.call(this); }, drawLegendSymbol: a.LegendSymbolMixin.drawRectangle,
                drawTracker: p.prototype.drawTracker, setStackedPoints: a.noop
            });
        });
        y(r, "parts-more/BubbleLegend.js", [r["parts/Globals.js"]], function (a) {
            var p = a.Series, l = a.Legend, e = a.Chart, h = a.addEvent, b = a.wrap, g = a.color, f = a.isNumber, c = a.numberFormat, t = a.objectEach, w = a.merge, x = a.noop, d = a.pick, q = a.stableSort, n = a.setOptions, u = a.arrayMin, v = a.arrayMax;
            n({
            legend: {
            bubbleLegend: {
            borderColor: void 0, borderWidth: 2, className: void 0, color: void 0, connectorClassName: void 0, connectorColor: void 0, connectorDistance: 60, connectorWidth: 1,
                enabled: !1, labels: { className: void 0, allowOverlap: !1, format: "", formatter: void 0, align: "right", style: { fontSize: 10, color: void 0 }, x: 0, y: 0 }, maxSize: 60, minSize: 10, legendIndex: 0, ranges: { value: void 0, borderColor: void 0, color: void 0, connectorColor: void 0 }, sizeBy: "area", sizeByAbsoluteValue: !1, zIndex: 1, zThreshold: 0
            }
            }
            });
            a.BubbleLegend = function (b, d) { this.init(b, d); };
            a.BubbleLegend.prototype = {
            init: function (b, d) { this.options = b; this.visible = !0; this.chart = d.chart; this.legend = d; }, setState: x, addToLegend: function (b) {
                b.splice(this.options.legendIndex, 0, this);
            }, drawLegendSymbol: function (b) {
                var a = this.chart, k = this.options, c = d(b.options.itemDistance, 20), e, g = k.ranges;
                e = k.connectorDistance;
                this.fontMetrics = a.renderer.fontMetrics(k.labels.style.fontSize.toString() + "px");
                g && g.length && f(g[0].value) ? (q(g, function (b, d) { return d.value - b.value; }), this.ranges = g, this.setOptions(), this.render(), a = this.getMaxLabelSize(), g = this.ranges[0].radius, b = 2 * g, e = e - g + a.width, e = 0 < e ? e : 0, this.maxLabel = a, this.movementX = "left" === k.labels.align ? e : 0, this.legendItemWidth = b + e + c, this.legendItemHeight =
                    b + this.fontMetrics.h / 2) : b.options.bubbleLegend.autoRanges = !0;
            }, setOptions: function () {
                var b = this.ranges, a = this.options, c = this.chart.series[a.seriesIndex], f = this.legend.baseline, e = { "z-index": a.zIndex, "stroke-width": a.borderWidth }, q = { "z-index": a.zIndex, "stroke-width": a.connectorWidth }, n = this.getLabelStyles(), u = c.options.marker.fillOpacity, h = this.chart.styledMode;
                b.forEach(function (k, m) {
                    h || (e.stroke = d(k.borderColor, a.borderColor, c.color), e.fill = d(k.color, a.color, 1 !== u ? g(c.color).setOpacity(u).get("rgba") :
                        c.color), q.stroke = d(k.connectorColor, a.connectorColor, c.color));
                    b[m].radius = this.getRangeRadius(k.value);
                    b[m] = w(b[m], { center: b[0].radius - b[m].radius + f });
                    h || w(!0, b[m], { bubbleStyle: w(!1, e), connectorStyle: w(!1, q), labelStyle: n });
                }, this);
            }, getLabelStyles: function () {
                var b = this.options, a = {}, c = "left" === b.labels.align, f = this.legend.options.rtl;
                t(b.labels.style, function (b, d) { "color" !== d && "fontSize" !== d && "z-index" !== d && (a[d] = b); });
                return w(!1, a, {
                "font-size": b.labels.style.fontSize, fill: d(b.labels.style.color, "#000000"),
                    "z-index": b.zIndex, align: f || c ? "right" : "left"
                });
            }, getRangeRadius: function (b) { var d = this.options; return this.chart.series[this.options.seriesIndex].getRadius.call(this, d.ranges[d.ranges.length - 1].value, d.ranges[0].value, d.minSize, d.maxSize, b); }, render: function () {
                var b = this.chart.renderer, d = this.options.zThreshold;
                this.symbols || (this.symbols = { connectors: [], bubbleItems: [], labels: [] });
                this.legendSymbol = b.g("bubble-legend");
                this.legendItem = b.g("bubble-legend-item");
                this.legendSymbol.translateX = 0;
                this.legendSymbol.translateY =
                    0;
                this.ranges.forEach(function (b) { b.value >= d && this.renderRange(b); }, this);
                this.legendSymbol.add(this.legendItem);
                this.legendItem.add(this.legendGroup);
                this.hideOverlappingLabels();
            }, renderRange: function (b) {
                var d = this.options, a = d.labels, c = this.chart.renderer, k = this.symbols, f = k.labels, e = b.center, q = Math.abs(b.radius), g = d.connectorDistance, n = a.align, u = a.style.fontSize, g = this.legend.options.rtl || "left" === n ? -g : g, a = d.connectorWidth, h = this.ranges[0].radius, p = e - q - d.borderWidth / 2 + a / 2, v, u = u / 2 - (this.fontMetrics.h -
                    u) / 2, l = c.styledMode;
                "center" === n && (g = 0, d.connectorDistance = 0, b.labelStyle.align = "center");
                n = p + d.labels.y;
                v = h + g + d.labels.x;
                k.bubbleItems.push(c.circle(h, e + ((p % 1 ? 1 : .5) - (a % 2 ? 0 : .5)), q).attr(l ? {} : b.bubbleStyle).addClass((l ? "highcharts-color-" + this.options.seriesIndex + " " : "") + "highcharts-bubble-legend-symbol " + (d.className || "")).add(this.legendSymbol));
                k.connectors.push(c.path(c.crispLine(["M", h, p, "L", h + g, p], d.connectorWidth)).attr(l ? {} : b.connectorStyle).addClass((l ? "highcharts-color-" + this.options.seriesIndex +
                    " " : "") + "highcharts-bubble-legend-connectors " + (d.connectorClassName || "")).add(this.legendSymbol));
                b = c.text(this.formatLabel(b), v, n + u).attr(l ? {} : b.labelStyle).addClass("highcharts-bubble-legend-labels " + (d.labels.className || "")).add(this.legendSymbol);
                f.push(b);
                b.placed = !0;
                b.alignAttr = { x: v, y: n + u };
            }, getMaxLabelSize: function () { var b, d; this.symbols.labels.forEach(function (a) { d = a.getBBox(!0); b = b ? d.width > b.width ? d : b : d; }); return b || {}; }, formatLabel: function (b) {
                var d = this.options, k = d.labels.formatter;
                return (d =
                    d.labels.format) ? a.format(d, b) : k ? k.call(b) : c(b.value, 1);
            }, hideOverlappingLabels: function () { var b = this.chart, d = this.symbols; !this.options.labels.allowOverlap && d && (b.hideOverlappingLabels(d.labels), d.labels.forEach(function (b, a) { b.newOpacity ? b.newOpacity !== b.oldOpacity && d.connectors[a].show() : d.connectors[a].hide(); })); }, getRanges: function () {
                var b = this.legend.bubbleLegend, a, c = b.options.ranges, e, q = Number.MAX_VALUE, g = -Number.MAX_VALUE;
                b.chart.series.forEach(function (b) {
                    b.isBubble && !b.ignoreSeries && (e = b.zData.filter(f),
                        e.length && (q = d(b.options.zMin, Math.min(q, Math.max(u(e), !1 === b.options.displayNegative ? b.options.zThreshold : -Number.MAX_VALUE))), g = d(b.options.zMax, Math.max(g, v(e)))));
                });
                a = q === g ? [{ value: g }] : [{ value: q }, { value: (q + g) / 2 }, { value: g, autoRanges: !0 }];
                c.length && c[0].radius && a.reverse();
                a.forEach(function (b, d) { c && c[d] && (a[d] = w(!1, c[d], b)); });
                return a;
            }, predictBubbleSizes: function () {
                var b = this.chart, d = this.fontMetrics, a = b.legend.options, c = "horizontal" === a.layout, f = c ? b.legend.lastLineHeight : 0, e = b.plotSizeX, q = b.plotSizeY, g = b.series[this.options.seriesIndex], b = Math.ceil(g.minPxSize), n = Math.ceil(g.maxPxSize), g = g.options.maxSize, u = Math.min(q, e);
                if (a.floating || !/%$/.test(g))
                    d = n;
                else if (g = parseFloat(g), d = (u + f - d.h / 2) * g / 100 / (g / 100 + 1), c && q - d >= e || !c && e - d >= q)
                    d = n;
                return [b, Math.ceil(d)];
            }, updateRanges: function (b, d) { var a = this.legend.options.bubbleLegend; a.minSize = b; a.maxSize = d; a.ranges = this.getRanges(); }, correctSizes: function () {
                var b = this.legend, d = this.chart.series[this.options.seriesIndex];
                1 < Math.abs(Math.ceil(d.maxPxSize) - this.options.maxSize) &&
                    (this.updateRanges(this.options.minSize, d.maxPxSize), b.render());
            }
            };
            h(a.Legend, "afterGetAllItems", function (b) { var d = this.bubbleLegend, c = this.options, k = c.bubbleLegend, f = this.chart.getVisibleBubbleSeriesIndex(); d && d.ranges && d.ranges.length && (k.ranges.length && (k.autoRanges = !!k.ranges[0].autoRanges), this.destroyItem(d)); 0 <= f && c.enabled && k.enabled && (k.seriesIndex = f, this.bubbleLegend = new a.BubbleLegend(k, this), this.bubbleLegend.addToLegend(b.allItems)); });
            e.prototype.getVisibleBubbleSeriesIndex = function () {
                for (var b = this.series, d = 0; d < b.length;) {
                    if (b[d] && b[d].isBubble && b[d].visible && b[d].zData.length)
                        return d;
                    d++;
                }
                return -1;
            };
            l.prototype.getLinesHeights = function () {
            var b = this.allItems, d = [], a, c = b.length, f, e = 0; for (f = 0; f < c; f++)
                if (b[f].legendItemHeight && (b[f].itemHeight = b[f].legendItemHeight), b[f] === b[c - 1] || b[f + 1] && b[f]._legendItemPos[1] !== b[f + 1]._legendItemPos[1]) {
                    d.push({ height: 0 });
                    a = d[d.length - 1];
                    for (e; e <= f; e++)
                        b[e].itemHeight > a.height && (a.height = b[e].itemHeight);
                    a.step = f;
                } return d;
            };
            l.prototype.retranslateItems = function (b) {
                var d, a, c, f = this.options.rtl, e = 0;
                this.allItems.forEach(function (k, g) {
                d = k.legendGroup.translateX; a = k._legendItemPos[1]; if ((c = k.movementX) || f && k.ranges)
                    c = f ? d - k.options.maxSize / 2 : d + c, k.legendGroup.attr({ translateX: c }); g > b[e].step && e++; k.legendGroup.attr({ translateY: Math.round(a + b[e].height / 2) }); k._legendItemPos[1] = a + b[e].height / 2;
                });
            };
            h(p, "legendItemClick", function () {
                var b = this.chart, d = this.visible, a = this.chart.legend;
                a && a.bubbleLegend && (this.visible = !d, this.ignoreSeries = d, b = 0 <= b.getVisibleBubbleSeriesIndex(),
                    a.bubbleLegend.visible !== b && (a.update({ bubbleLegend: { enabled: b } }), a.bubbleLegend.visible = b), this.visible = d);
            });
            b(e.prototype, "drawChartBox", function (b, d, a) {
                var c = this.legend, f = 0 <= this.getVisibleBubbleSeriesIndex(), e;
                c && c.options.enabled && c.bubbleLegend && c.options.bubbleLegend.autoRanges && f ? (e = c.bubbleLegend.options, f = c.bubbleLegend.predictBubbleSizes(), c.bubbleLegend.updateRanges(f[0], f[1]), e.placed || (c.group.placed = !1, c.allItems.forEach(function (b) { b.legendGroup.translateY = null; })), c.render(), this.getMargins(),
                    this.axes.forEach(function (b) { b.render(); e.placed || (b.setScale(), b.updateNames(), t(b.ticks, function (b) { b.isNew = !0; b.isNewLabel = !0; })); }), e.placed = !0, this.getMargins(), b.call(this, d, a), c.bubbleLegend.correctSizes(), c.retranslateItems(c.getLinesHeights())) : (b.call(this, d, a), c && c.options.enabled && c.bubbleLegend && (c.render(), c.retranslateItems(c.getLinesHeights())));
            });
        });
        y(r, "parts-more/BubbleSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.arrayMax, l = a.arrayMin, e = a.Axis, h = a.color, b = a.isNumber, g = a.noop, f = a.pick, c = a.pInt, t = a.Point, w = a.Series, x = a.seriesType, d = a.seriesTypes;
            x("bubble", "scatter", { dataLabels: { formatter: function () { return this.point.z; }, inside: !0, verticalAlign: "middle" }, animationLimit: 250, marker: { lineColor: null, lineWidth: 1, fillOpacity: .5, radius: null, states: { hover: { radiusPlus: 0 } }, symbol: "circle" }, minSize: 8, maxSize: "20%", softThreshold: !1, states: { hover: { halo: { size: 5 } } }, tooltip: { pointFormat: "({point.x}, {point.y}), Size: {point.z}" }, turboThreshold: 0, zThreshold: 0, zoneAxis: "z" }, {
            pointArrayMap: ["y",
                "z"], parallelArrays: ["x", "y", "z"], trackerGroups: ["group", "dataLabelsGroup"], specialGroup: "group", bubblePadding: !0, zoneAxis: "z", directTouch: !0, isBubble: !0, pointAttribs: function (b, d) { var a = this.options.marker.fillOpacity; b = w.prototype.pointAttribs.call(this, b, d); 1 !== a && (b.fill = h(b.fill).setOpacity(a).get("rgba")); return b; }, getRadii: function (b, d, a) {
                var c, f = this.zData, e = a.minPxSize, g = a.maxPxSize, q = [], n; c = 0; for (a = f.length; c < a; c++)
                    n = f[c], q.push(this.getRadius(b, d, e, g, n)); this.radii = q;
                }, getRadius: function (d, a, c, f, e) { var g = this.options, k = "width" !== g.sizeBy, q = g.zThreshold, n = a - d; g.sizeByAbsoluteValue && null !== e && (e = Math.abs(e - q), n = Math.max(a - q, Math.abs(d - q)), d = 0); b(e) ? e < d ? c = c / 2 - 1 : (d = 0 < n ? (e - d) / n : .5, k && 0 <= d && (d = Math.sqrt(d)), c = Math.ceil(c + d * (f - c)) / 2) : c = null; return c; }, animate: function (b) {
                    !b && this.points.length < this.options.animationLimit && (this.points.forEach(function (b) { var d = b.graphic, a; d && d.width && (a = { x: d.x, y: d.y, width: d.width, height: d.height }, d.attr({ x: b.plotX, y: b.plotY, width: 1, height: 1 }), d.animate(a, this.options.animation)); }, this), this.animate = null);
                }, hasData: function () { return !!this.processedXData.length; }, translate: function () {
                var c, f = this.data, e, g, k = this.radii; d.scatter.prototype.translate.call(this); for (c = f.length; c--;)
                    e = f[c], g = k ? k[c] : 0, b(g) && g >= this.minPxSize / 2 ? (e.marker = a.extend(e.marker, { radius: g, width: 2 * g, height: 2 * g }), e.dlBox = { x: e.plotX - g, y: e.plotY - g, width: 2 * g, height: 2 * g }) : e.shapeArgs = e.plotY = e.dlBox = void 0;
                }, alignDataLabel: d.column.prototype.alignDataLabel, buildKDTree: g, applyZones: g
            }, {
            haloPath: function (b) {
                return t.prototype.haloPath.call(this, 0 === b ? 0 : (this.marker ? this.marker.radius || 0 : 0) + b);
            }, ttBelow: !1
                });
            e.prototype.beforePadding = function () {
                var d = this, e = this.len, g = this.chart, h = 0, k = e, m = this.isXAxis, t = m ? "xData" : "yData", w = this.min, x = {}, r = Math.min(g.plotWidth, g.plotHeight), B = Number.MAX_VALUE, y = -Number.MAX_VALUE, z = this.max - w, H = e / z, C = [];
                this.series.forEach(function (b) {
                    var e = b.options;
                    !b.bubblePadding || !b.visible && g.options.chart.ignoreHiddenSeries || (d.allowZoomOutside = !0, C.push(b), m && (["minSize", "maxSize"].forEach(function (b) {
                        var d = e[b], a = /%$/.test(d), d = c(d);
                        x[b] = a ? r * d / 100 : d;
                    }), b.minPxSize = x.minSize, b.maxPxSize = Math.max(x.maxSize, x.minSize), b = b.zData.filter(a.isNumber), b.length && (B = f(e.zMin, Math.min(B, Math.max(l(b), !1 === e.displayNegative ? e.zThreshold : -Number.MAX_VALUE))), y = f(e.zMax, Math.max(y, p(b))))));
                });
                C.forEach(function (a) {
                var c = a[t], e = c.length, f; m && a.getRadii(B, y, a); if (0 < z)
                    for (; e--;)
                        b(c[e]) && d.dataMin <= c[e] && c[e] <= d.dataMax && (f = a.radii[e], h = Math.min((c[e] - w) * H - f, h), k = Math.max((c[e] - w) * H + f, k));
                });
                C.length && 0 < z && !this.isLog && (k -= e, H *= (e + Math.max(0, h) - Math.min(k, e)) / e, [["min", "userMin", h], ["max", "userMax", k]].forEach(function (b) { void 0 === f(d.options[b[0]], d[b[1]]) && (d[b[0]] += b[2] / H); }));
            };
        });
        y(r, "modules/networkgraph/integrations.js", [r["parts/Globals.js"]], function (a) {
            a.networkgraphIntegrations = {
            verlet: {
            attractiveForceFunction: function (a, l) { return (l - a) / a; }, repulsiveForceFunction: function (a, l) { return (l - a) / a * (l > a ? 1 : 0); }, barycenter: function () {
                var a = this.options.gravitationalConstant, l = this.barycenter.xFactor, e = this.barycenter.yFactor, l = (l - (this.box.left +
                    this.box.width) / 2) * a, e = (e - (this.box.top + this.box.height) / 2) * a;
                this.nodes.forEach(function (a) { a.fixedPosition || (a.plotX -= l / a.mass / a.degree, a.plotY -= e / a.mass / a.degree); });
            }, repulsive: function (a, l, e) { l = l * this.diffTemperature / a.mass / a.degree; a.fixedPosition || (a.plotX += e.x * l, a.plotY += e.y * l); }, attractive: function (a, l, e) {
                var h = a.getMass(), b = -e.x * l * this.diffTemperature;
                l = -e.y * l * this.diffTemperature;
                a.fromNode.fixedPosition || (a.fromNode.plotX -= b * h.fromNode / a.fromNode.degree, a.fromNode.plotY -= l * h.fromNode / a.fromNode.degree);
                a.toNode.fixedPosition || (a.toNode.plotX += b * h.toNode / a.toNode.degree, a.toNode.plotY += l * h.toNode / a.toNode.degree);
            }, integrate: function (a, l) { var e = -a.options.friction, h = a.options.maxSpeed, b = (l.plotX + l.dispX - l.prevX) * e, e = (l.plotY + l.dispY - l.prevY) * e, g = Math.abs, f = g(b) / (b || 1), g = g(e) / (e || 1), b = f * Math.min(h, Math.abs(b)), e = g * Math.min(h, Math.abs(e)); l.prevX = l.plotX + l.dispX; l.prevY = l.plotY + l.dispY; l.plotX += b; l.plotY += e; l.temperature = a.vectorLength({ x: b, y: e }); }, getK: function (a) {
                return Math.pow(a.box.width * a.box.height /
                    a.nodes.length, .5);
            }
            }, euler: {
            attractiveForceFunction: function (a, l) { return a * a / l; }, repulsiveForceFunction: function (a, l) { return l * l / a; }, barycenter: function () {
            var a = this.options.gravitationalConstant, l = this.barycenter.xFactor, e = this.barycenter.yFactor; this.nodes.forEach(function (h) {
            if (!h.fixedPosition) {
                var b = h.getDegree(), b = b * (1 + b / 2);
                h.dispX += (l - h.plotX) * a * b / h.degree;
                h.dispY += (e - h.plotY) * a * b / h.degree;
            }
            });
            }, repulsive: function (a, l, e, h) { a.dispX += e.x / h * l / a.degree; a.dispY += e.y / h * l / a.degree; }, attractive: function (a, l, e, h) { var b = a.getMass(), g = e.x / h * l; l *= e.y / h; a.fromNode.fixedPosition || (a.fromNode.dispX -= g * b.fromNode / a.fromNode.degree, a.fromNode.dispY -= l * b.fromNode / a.fromNode.degree); a.toNode.fixedPosition || (a.toNode.dispX += g * b.toNode / a.toNode.degree, a.toNode.dispY += l * b.toNode / a.toNode.degree); }, integrate: function (a, l) {
                var e;
                l.dispX += l.dispX * a.options.friction;
                l.dispY += l.dispY * a.options.friction;
                e = l.temperature = a.vectorLength({ x: l.dispX, y: l.dispY });
                0 !== e && (l.plotX += l.dispX / e * Math.min(Math.abs(l.dispX), a.temperature),
                    l.plotY += l.dispY / e * Math.min(Math.abs(l.dispY), a.temperature));
            }, getK: function (a) { return Math.pow(a.box.width * a.box.height / a.nodes.length, .3); }
            }
            };
        });
        y(r, "modules/networkgraph/QuadTree.js", [r["parts/Globals.js"]], function (a) {
            var p = a.QuadTreeNode = function (a) { this.box = a; this.boxSize = Math.min(a.width, a.height); this.nodes = []; this.body = this.isInternal = !1; this.isEmpty = !0; };
            a.extend(p.prototype, {
            insert: function (a, h) {
                this.isInternal ? this.nodes[this.getBoxPosition(a)].insert(a, h - 1) : (this.isEmpty = !1, this.body ? h ?
                    (this.isInternal = !0, this.divideBox(), !0 !== this.body && (this.nodes[this.getBoxPosition(this.body)].insert(this.body, h - 1), this.body = !0), this.nodes[this.getBoxPosition(a)].insert(a, h - 1)) : this.nodes.push(a) : (this.isInternal = !1, this.body = a));
            }, updateMassAndCenter: function () {
                var a = 0, h = 0, b = 0;
                this.isInternal ? (this.nodes.forEach(function (e) { e.isEmpty || (a += e.mass, h += e.plotX * e.mass, b += e.plotY * e.mass); }), h /= a, b /= a) : this.body && (a = this.body.mass, h = this.body.plotX, b = this.body.plotY);
                this.mass = a;
                this.plotX = h;
                this.plotY =
                    b;
            }, divideBox: function () { var a = this.box.width / 2, h = this.box.height / 2; this.nodes[0] = new p({ left: this.box.left, top: this.box.top, width: a, height: h }); this.nodes[1] = new p({ left: this.box.left + a, top: this.box.top, width: a, height: h }); this.nodes[2] = new p({ left: this.box.left + a, top: this.box.top + h, width: a, height: h }); this.nodes[3] = new p({ left: this.box.left, top: this.box.top + h, width: a, height: h }); }, getBoxPosition: function (a) {
                var e = a.plotY < this.box.top + this.box.height / 2;
                return a.plotX < this.box.left + this.box.width / 2 ? e ? 0 :
                    3 : e ? 1 : 2;
            }
            });
            var l = a.QuadTree = function (a, h, b, g) { this.box = { left: a, top: h, width: b, height: g }; this.maxDepth = 25; this.root = new p(this.box, "0"); this.root.isInternal = !0; this.root.isRoot = !0; this.root.divideBox(); };
            a.extend(l.prototype, {
            insertNodes: function (a) { a.forEach(function (a) { this.root.insert(a, this.maxDepth); }, this); }, visitNodeRecursive: function (a, h, b, g, f) {
                var c;
                a || (a = this.root);
                a === this.root && h && (c = h(a));
                !1 !== c && (a.nodes.forEach(function (a) {
                    if (a.isInternal) {
                        h && (c = h(a));
                        if (!1 === c)
                            return;
                        this.visitNodeRecursive(a, h, b, g, f);
                    }
                    else
                        a.body && h && h(a.body);
                    b && b(a);
                }, this), a === this.root && b && b(a));
            }, calculateMassAndCenter: function () { this.visitNodeRecursive(null, null, function (a) { a.updateMassAndCenter(); }); }, render: function (a, h) { this.visitNodeRecursive(this.root, null, null, a, h); }, clear: function (a) { this.render(a, !0); }, renderBox: function (a, h, b) {
                a.graphic || b ? b && (a.graphic && (a.graphic = a.graphic.destroy()), a.graphic2 && (a.graphic2 = a.graphic2.destroy()), a.label && (a.label = a.label.destroy())) : (a.graphic = h.renderer.rect(a.box.left + h.plotLeft, a.box.top + h.plotTop, a.box.width, a.box.height).attr({ stroke: "rgba(100, 100, 100, 0.5)", "stroke-width": 2 }).add(), isNaN(a.plotX) || (a.graphic2 = h.renderer.circle(a.plotX, a.plotY, a.mass / 10).attr({ fill: "red", translateY: h.plotTop, translateX: h.plotLeft }).add()));
            }
            });
        });
        y(r, "modules/networkgraph/layouts.js", [r["parts/Globals.js"]], function (a) {
            var p = a.pick, l = a.defined, e = a.addEvent, h = a.Chart;
            a.layouts = { "reingold-fruchterman": function () { } };
            a.extend(a.layouts["reingold-fruchterman"].prototype, {
            init: function (b) {
                this.options =
                    b;
                this.nodes = [];
                this.links = [];
                this.series = [];
                this.box = { x: 0, y: 0, width: 0, height: 0 };
                this.setInitialRendering(!0);
                this.integration = a.networkgraphIntegrations[b.integration];
                this.attractiveForce = p(b.attractiveForce, this.integration.attractiveForceFunction);
                this.repulsiveForce = p(b.repulsiveForce, this.integration.repulsiveForceFunction);
                this.approximation = b.approximation;
            }, start: function () {
                var b = this.series, a = this.options;
                this.currentStep = 0;
                this.forces = b[0] && b[0].forces || [];
                this.initialRendering && (this.initPositions(),
                    b.forEach(function (b) { b.render(); }));
                this.setK();
                this.resetSimulation(a);
                a.enableSimulation && this.step();
            }, step: function () {
                var b = this, g = this.series, f = this.options;
                b.currentStep++;
                "barnes-hut" === b.approximation && (b.createQuadTree(), b.quadTree.calculateMassAndCenter());
                b.forces.forEach(function (a) { b[a + "Forces"](b.temperature); });
                b.applyLimits(b.temperature);
                b.temperature = b.coolDown(b.startTemperature, b.diffTemperature, b.currentStep);
                b.prevSystemTemperature = b.systemTemperature;
                b.systemTemperature = b.getSystemTemperature();
                f.enableSimulation && (g.forEach(function (b) { b.chart && b.render(); }), b.maxIterations-- && isFinite(b.temperature) && !b.isStable() ? (b.simulation && a.win.cancelAnimationFrame(b.simulation), b.simulation = a.win.requestAnimationFrame(function () { b.step(); })) : b.simulation = !1);
            }, stop: function () { this.simulation && a.win.cancelAnimationFrame(this.simulation); }, setArea: function (b, a, f, c) { this.box = { left: b, top: a, width: f, height: c }; }, setK: function () { this.k = this.options.linkLength || this.integration.getK(this); }, addNodes: function (b) {
                b.forEach(function (b) {
                    -1 ===
                        this.nodes.indexOf(b) && this.nodes.push(b);
                }, this);
            }, removeNode: function (b) { b = this.nodes.indexOf(b); -1 !== b && this.nodes.splice(b, 1); }, removeLink: function (b) { b = this.links.indexOf(b); -1 !== b && this.links.splice(b, 1); }, addLinks: function (b) { b.forEach(function (b) { -1 === this.links.indexOf(b) && this.links.push(b); }, this); }, addSeries: function (b) { -1 === this.series.indexOf(b) && this.series.push(b); }, clear: function () { this.nodes.length = 0; this.links.length = 0; this.series.length = 0; this.resetSimulation(); }, resetSimulation: function () {
                this.forcedStop =
                    !1;
                this.systemTemperature = 0;
                this.setMaxIterations();
                this.setTemperature();
                this.setDiffTemperature();
            }, setMaxIterations: function (b) { this.maxIterations = p(b, this.options.maxIterations); }, setTemperature: function () { this.temperature = this.startTemperature = Math.sqrt(this.nodes.length); }, setDiffTemperature: function () { this.diffTemperature = this.startTemperature / (this.options.maxIterations + 1); }, setInitialRendering: function (b) { this.initialRendering = b; }, createQuadTree: function () {
                this.quadTree = new a.QuadTree(this.box.left, this.box.top, this.box.width, this.box.height);
                this.quadTree.insertNodes(this.nodes);
            }, initPositions: function () { var b = this.options.initialPositions; a.isFunction(b) ? (b.call(this), this.nodes.forEach(function (b) { l(b.prevX) || (b.prevX = b.plotX); l(b.prevY) || (b.prevY = b.plotY); b.dispX = 0; b.dispY = 0; })) : "circle" === b ? this.setCircularPositions() : this.setRandomPositions(); }, setCircularPositions: function () {
                function b(a) { a.linksFrom.forEach(function (a) { l[a.toNode.id] || (l[a.toNode.id] = !0, h.push(a.toNode), b(a.toNode)); }); }
                var a = this.box, f = this.nodes, c = 2 * Math.PI / (f.length + 1), e = f.filter(function (b) { return 0 === b.linksTo.length; }), h = [], l = {}, d = this.options.initialPositionRadius;
                e.forEach(function (a) { h.push(a); b(a); });
                h.length ? f.forEach(function (b) { -1 === h.indexOf(b) && h.push(b); }) : h = f;
                h.forEach(function (b, f) { b.plotX = b.prevX = p(b.plotX, a.width / 2 + d * Math.cos(f * c)); b.plotY = b.prevY = p(b.plotY, a.height / 2 + d * Math.sin(f * c)); b.dispX = 0; b.dispY = 0; });
            }, setRandomPositions: function () {
                function b(b) { b = b * b / Math.PI; return b -= Math.floor(b); }
                var a = this.box, f = this.nodes, c = f.length + 1;
                f.forEach(function (f, e) { f.plotX = f.prevX = p(f.plotX, a.width * b(e)); f.plotY = f.prevY = p(f.plotY, a.height * b(c + e)); f.dispX = 0; f.dispY = 0; });
            }, force: function (b) { this.integration[b].apply(this, Array.prototype.slice.call(arguments, 1)); }, barycenterForces: function () { this.getBarycenter(); this.force("barycenter"); }, getBarycenter: function () { var b = 0, a = 0, f = 0; this.nodes.forEach(function (c) { a += c.plotX * c.mass; f += c.plotY * c.mass; b += c.mass; }); return this.barycenter = { x: a, y: f, xFactor: a / b, yFactor: f / b }; }, barnesHutApproximation: function (b, a) { var f = this.getDistXY(b, a), c = this.vectorLength(f), e, g; b !== a && 0 !== c && (a.isInternal ? a.boxSize / c < this.options.theta && 0 !== c ? (g = this.repulsiveForce(c, this.k), this.force("repulsive", b, g * a.mass, f, c), e = !1) : e = !0 : (g = this.repulsiveForce(c, this.k), this.force("repulsive", b, g * a.mass, f, c))); return e; }, repulsiveForces: function () {
                var b = this;
                "barnes-hut" === b.approximation ? b.nodes.forEach(function (a) { b.quadTree.visitNodeRecursive(null, function (f) { return b.barnesHutApproximation(a, f); }); }) : b.nodes.forEach(function (a) {
                    b.nodes.forEach(function (f) {
                        var c, e, g;
                        a === f || a.fixedPosition || (g = b.getDistXY(a, f), e = b.vectorLength(g), c = b.repulsiveForce(e, b.k), b.force("repulsive", a, c * f.mass, g, e));
                    });
                });
            }, attractiveForces: function () { var b = this, a, f, c; b.links.forEach(function (e) { e.fromNode && e.toNode && (a = b.getDistXY(e.fromNode, e.toNode), f = b.vectorLength(a), 0 !== f && (c = b.attractiveForce(f, b.k), b.force("attractive", e, c, a, f))); }); }, applyLimits: function () {
                var b = this;
                b.nodes.forEach(function (a) {
                    a.fixedPosition || (b.integration.integrate(b, a), b.applyLimitBox(a, b.box), a.dispX = 0,
                        a.dispY = 0);
                });
            }, applyLimitBox: function (b, a) { var f = b.marker && b.marker.radius || 0; b.plotX = Math.max(Math.min(b.plotX, a.width - f), a.left + f); b.plotY = Math.max(Math.min(b.plotY, a.height - f), a.top + f); }, coolDown: function (b, a, f) { return b - a * f; }, isStable: function () { return .00001 > Math.abs(this.systemTemperature - this.prevSystemTemperature) || 0 >= this.temperature; }, getSystemTemperature: function () { return this.nodes.reduce(function (a, e) { return a + e.temperature; }, 0); }, vectorLength: function (a) { return Math.sqrt(a.x * a.x + a.y * a.y); },
                getDistR: function (a, e) { a = this.getDistXY(a, e); return this.vectorLength(a); }, getDistXY: function (a, e) { var b = a.plotX - e.plotX; a = a.plotY - e.plotY; return { x: b, y: a, absX: Math.abs(b), absY: Math.abs(a) }; }
            });
            e(h, "predraw", function () { this.graphLayoutsLookup && this.graphLayoutsLookup.forEach(function (a) { a.stop(); }); });
            e(h, "render", function () {
                function b(a) { a.maxIterations-- && isFinite(a.temperature) && !a.isStable() && !a.options.enableSimulation && (a.beforeStep && a.beforeStep(), a.step(), e = !1, f = !0); }
                var e, f = !1;
                if (this.graphLayoutsLookup) {
                    a.setAnimation(!1, this);
                    for (this.graphLayoutsLookup.forEach(function (a) { a.start(); }); !e;)
                        e = !0, this.graphLayoutsLookup.forEach(b);
                    f && this.series.forEach(function (a) { a && a.layout && a.render(); });
                }
            });
        });
        y(r, "modules/networkgraph/draggable-nodes.js", [r["parts/Globals.js"]], function (a) {
            var p = a.Chart, l = a.addEvent;
            a.dragNodesMixin = {
            onMouseDown: function (a, h) { h = this.chart.pointer.normalize(h); a.fixedPosition = { chartX: h.chartX, chartY: h.chartY, plotX: a.plotX, plotY: a.plotY }; a.inDragMode = !0; }, onMouseMove: function (a, h) {
                if (a.fixedPosition &&
                    a.inDragMode) {
                    var b = this.chart, e = b.pointer.normalize(h);
                    h = a.fixedPosition.chartX - e.chartX;
                    e = a.fixedPosition.chartY - e.chartY;
                    if (5 < Math.abs(h) || 5 < Math.abs(e))
                        h = a.fixedPosition.plotX - h, e = a.fixedPosition.plotY - e, b.isInsidePlot(h, e) && (a.plotX = h, a.plotY = e, this.redrawHalo(a), this.layout.simulation ? this.layout.resetSimulation() : (this.layout.setInitialRendering(!1), this.layout.enableSimulation ? this.layout.start() : this.layout.setMaxIterations(1), this.chart.redraw(), this.layout.setInitialRendering(!0)));
                }
            }, onMouseUp: function (a) {
                a.fixedPosition &&
                    (this.layout.enableSimulation ? this.layout.start() : this.chart.redraw(), a.inDragMode = !1, this.options.fixedDraggable || delete a.fixedPosition);
            }, redrawHalo: function (a) { a && this.halo && this.halo.attr({ d: a.haloPath(this.options.states.hover.halo.size) }); }
            };
            l(p, "load", function () {
                var a = this, h, b, g;
                a.container && (h = l(a.container, "mousedown", function (f) {
                    var c = a.hoverPoint;
                    c && c.series && c.series.hasDraggableNodes && c.series.options.draggable && (c.series.onMouseDown(c, f), b = l(a.container, "mousemove", function (a) {
                        return c &&
                            c.series && c.series.onMouseMove(c, a);
                    }), g = l(a.container.ownerDocument, "mouseup", function (a) { b(); g(); return c && c.series && c.series.onMouseUp(c, a); }));
                }));
                l(a, "destroy", function () { h(); });
            });
        });
        y(r, "parts-more/PackedBubbleSeries.js", [r["parts/Globals.js"]], function (a) {
            var p = a.seriesType, l = a.Series, e = a.Point, h = a.defined, b = a.pick, g = a.addEvent, f = a.Chart, c = a.Color, t = a.layouts["reingold-fruchterman"], w = a.seriesTypes.bubble.prototype.pointClass, x = a.dragNodesMixin;
            a.networkgraphIntegrations.packedbubble = {
            repulsiveForceFunction: function (a, b, c, f) { return Math.min(a, (c.marker.radius + f.marker.radius) / 2); }, barycenter: function () { var a = this, b = a.options.gravitationalConstant, c = a.box, f = a.nodes, e, k; f.forEach(function (d) { a.options.splitSeries && !d.isParentNode ? (e = d.series.parentNode.plotX, k = d.series.parentNode.plotY) : (e = c.width / 2, k = c.height / 2); d.fixedPosition || (d.plotX -= (d.plotX - e) * b / (d.mass * Math.sqrt(f.length)), d.plotY -= (d.plotY - k) * b / (d.mass * Math.sqrt(f.length))); }); }, repulsive: function (a, b, c, f) {
                var d = b * this.diffTemperature / a.mass / a.degree;
                b = c.x *
                    d;
                c = c.y * d;
                a.fixedPosition || (a.plotX += b, a.plotY += c);
                f.fixedPosition || (f.plotX -= b, f.plotY -= c);
            }, integrate: a.networkgraphIntegrations.verlet.integrate, getK: a.noop
            };
            a.layouts.packedbubble = a.extendClass(t, {
            beforeStep: function () { this.options.marker && this.series.forEach(function (a) { a && (a.translate(), a.drawPoints()); }); }, setCircularPositions: function () {
                var a = this, c = a.box, f = a.nodes, e = 2 * Math.PI / (f.length + 1), g, k, m = a.options.initialPositionRadius;
                f.forEach(function (d, f) {
                    a.options.splitSeries && !d.isParentNode ? (g =
                        d.series.parentNode.plotX, k = d.series.parentNode.plotY) : (g = c.width / 2, k = c.height / 2);
                    d.plotX = d.prevX = b(d.plotX, g + m * Math.cos(d.index || f * e));
                    d.plotY = d.prevY = b(d.plotY, k + m * Math.sin(d.index || f * e));
                    d.dispX = 0;
                    d.dispY = 0;
                });
            }, repulsiveForces: function () {
                var a = this, b, c, f, e = a.options.bubblePadding;
                a.nodes.forEach(function (d) {
                    d.degree = d.mass;
                    d.neighbours = 0;
                    a.nodes.forEach(function (k) {
                        b = 0;
                        d === k || d.fixedPosition || !a.options.seriesInteraction && d.series !== k.series || (f = a.getDistXY(d, k), c = a.vectorLength(f) - (d.marker.radius +
                            k.marker.radius + e), 0 > c && (d.degree += .01, d.neighbours++ , b = a.repulsiveForce(-c / Math.sqrt(d.neighbours), a.k, d, k)), a.force("repulsive", d, b * k.mass, f, k, c));
                    });
                });
            }, applyLimitBox: function (a) { var b, d; this.options.splitSeries && !a.isParentNode && this.options.parentNodeLimit && (b = this.getDistXY(a, a.series.parentNode), d = a.series.parentNodeRadius - a.marker.radius - this.vectorLength(b), 0 > d && d > -2 * a.marker.radius && (a.plotX -= .01 * b.x, a.plotY -= .01 * b.y)); t.prototype.applyLimitBox.apply(this, arguments); }, isStable: function () {
                return .00001 >
                    Math.abs(this.systemTemperature - this.prevSystemTemperature) || 0 >= this.temperature || 0 < this.systemTemperature && .01 > this.systemTemperature / this.nodes.length;
            }
            });
            p("packedbubble", "bubble", {
            minSize: "10%", maxSize: "50%", sizeBy: "area", zoneAxis: "y", tooltip: { pointFormat: "Value: {point.value}" }, draggable: !0, useSimulation: !0, dataLabels: { formatter: function () { return this.point.value; }, parentNodeFormatter: function () { return this.name; }, parentNodeTextPath: { enabled: !0 }, padding: 0 }, layoutAlgorithm: {
            initialPositions: "circle",
                initialPositionRadius: 20, bubblePadding: 5, parentNodeLimit: !1, seriesInteraction: !0, dragBetweenSeries: !1, parentNodeOptions: { maxIterations: 400, gravitationalConstant: .03, maxSpeed: 50, initialPositionRadius: 100, seriesInteraction: !0, marker: { fillColor: null, fillOpacity: 1, lineWidth: 1, lineColor: null, symbol: "circle" } }, enableSimulation: !0, type: "packedbubble", integration: "packedbubble", maxIterations: 1E3, splitSeries: !1, maxSpeed: 5, gravitationalConstant: .01, friction: -.981
            }
            }, {
            hasDraggableNodes: !0, forces: ["barycenter",
                "repulsive"], pointArrayMap: ["value"], pointValKey: "value", isCartesian: !1, axisTypes: [], noSharedTooltip: !0, accumulateAllPoints: function (a) {
                var b = a.chart, d = [], c, f; for (c = 0; c < b.series.length; c++)
                    if (a = b.series[c], a.visible || !b.options.chart.ignoreHiddenSeries)
                        for (f = 0; f < a.yData.length; f++)
                            d.push([null, null, a.yData[f], a.index, f, { id: f, marker: { radius: 0 } }]); return d;
                }, init: function () {
                    l.prototype.init.apply(this, arguments);
                    g(this, "updatedData", function () {
                        this.chart.series.forEach(function (a) {
                            a.type === this.type &&
                                (a.isDirty = !0);
                        }, this);
                    });
                    return this;
                }, render: function () { var b = []; l.prototype.render.apply(this, arguments); this.data.forEach(function (d) { a.isArray(d.dataLabels) && d.dataLabels.forEach(function (a) { b.push(a); }); }); this.chart.hideOverlappingLabels(b); }, setVisible: function () {
                    var a = this;
                    l.prototype.setVisible.apply(a, arguments);
                    a.parentNodeLayout && a.graph ? a.visible ? (a.graph.show(), a.parentNode.dataLabel && a.parentNode.dataLabel.show()) : (a.graph.hide(), a.parentNodeLayout.removeNode(a.parentNode), a.parentNode.dataLabel &&
                        a.parentNode.dataLabel.hide()) : a.layout && (a.visible ? a.layout.addNodes(a.points) : a.points.forEach(function (b) { a.layout.removeNode(b); }));
                }, drawDataLabels: function () {
                    var a = this.options.dataLabels.textPath, b = this.points;
                    l.prototype.drawDataLabels.apply(this, arguments);
                    this.parentNode && (this.parentNode.formatPrefix = "parentNode", this.points = [this.parentNode], this.options.dataLabels.textPath = this.options.dataLabels.parentNodeTextPath, l.prototype.drawDataLabels.apply(this, arguments), this.points = b, this.options.dataLabels.textPath =
                        a);
                }, calculateParentRadius: function () { var a; this.group && (a = this.group.element.getBBox()); this.parentNodeRadius = Math.min(Math.max(Math.sqrt(2 * this.parentNodeMass / Math.PI) + 20, 20), a ? Math.max(Math.sqrt(Math.pow(a.width, 2) + Math.pow(a.height, 2)) / 2 + 20, 20) : Math.sqrt(2 * this.parentNodeMass / Math.PI) + 20); this.parentNode && (this.parentNode.marker.radius = this.parentNodeRadius); }, drawGraph: function () {
                    if (this.layout && this.layout.options.splitSeries) {
                        var b = this.chart, f, e = this.layout.options.parentNodeOptions.marker, e = { fill: e.fillColor || c(this.color).brighten(.4).get(), opacity: e.fillOpacity, stroke: e.lineColor || this.color, "stroke-width": e.lineWidth };
                        f = this.visible ? "inherit" : "hidden";
                        this.parentNodesGroup || (this.parentNodesGroup = this.plotGroup("parentNodesGroup", "parentNode", f, .1, b.seriesGroup), this.group.attr({ zIndex: 2 }));
                        this.calculateParentRadius();
                        f = a.merge({ x: this.parentNode.plotX - this.parentNodeRadius, y: this.parentNode.plotY - this.parentNodeRadius, width: 2 * this.parentNodeRadius, height: 2 * this.parentNodeRadius }, e);
                        this.graph ? this.graph.attr(f) : this.graph = this.parentNode.graphic = b.renderer.symbol(e.symbol).attr(f).add(this.parentNodesGroup);
                    }
                }, createParentNodes: function () {
                    var a = this, b = a.chart, c = a.parentNodeLayout, f, e = a.parentNode;
                    a.parentNodeMass = 0;
                    a.points.forEach(function (b) { a.parentNodeMass += Math.PI * Math.pow(b.marker.radius, 2); });
                    a.calculateParentRadius();
                    c.nodes.forEach(function (b) { b.seriesIndex === a.index && (f = !0); });
                    c.setArea(0, 0, b.plotWidth, b.plotHeight);
                    f || (e || (e = (new w).init(this, {
                    mass: a.parentNodeRadius /
                        2, marker: { radius: a.parentNodeRadius }, dataLabels: { inside: !1 }, dataLabelOnNull: !0, degree: a.parentNodeRadius, isParentNode: !0, seriesIndex: a.index
                    })), a.parentNode && (e.plotX = a.parentNode.plotX, e.plotY = a.parentNode.plotY), a.parentNode = e, c.addSeries(a), c.addNodes([e]));
                }, addSeriesLayout: function () {
                    var b = this.options.layoutAlgorithm, c = this.chart.graphLayoutsStorage, f = this.chart.graphLayoutsLookup, e = a.merge(b, b.parentNodeOptions, { enableSimulation: this.layout.options.enableSimulation }), g;
                    g = c[b.type + "-series"];
                    g || (c[b.type + "-series"] = g = new a.layouts[b.type], g.init(e), f.splice(g.index, 0, g));
                    this.parentNodeLayout = g;
                    this.createParentNodes();
                }, addLayout: function () {
                    var b = this.options.layoutAlgorithm, c = this.chart.graphLayoutsStorage, f = this.chart.graphLayoutsLookup, e = this.chart.options.chart, g;
                    c || (this.chart.graphLayoutsStorage = c = {}, this.chart.graphLayoutsLookup = f = []);
                    g = c[b.type];
                    g || (b.enableSimulation = h(e.forExport) ? !e.forExport : b.enableSimulation, c[b.type] = g = new a.layouts[b.type], g.init(b), f.splice(g.index, 0, g));
                    this.layout = g;
                    this.points.forEach(function (a) { a.mass = 2; a.degree = 1; a.collisionNmb = 1; });
                    g.setArea(0, 0, this.chart.plotWidth, this.chart.plotHeight);
                    g.addSeries(this);
                    g.addNodes(this.points);
                }, deferLayout: function () { var a = this.options.layoutAlgorithm; this.visible && (this.addLayout(), a.splitSeries && this.addSeriesLayout()); }, translate: function () {
                    var b = this.chart, c = this.data, f = this.index, e, g, k, m, l = this.options.useSimulation;
                    this.processedXData = this.xData;
                    this.generatePoints();
                    h(b.allDataPoints) || (b.allDataPoints =
                        this.accumulateAllPoints(this), this.getPointRadius());
                    l ? k = b.allDataPoints : (k = this.placeBubbles(b.allDataPoints), this.options.draggable = !1);
                    for (m = 0; m < k.length; m++)
                        k[m][3] === f && (e = c[k[m][4]], g = k[m][2], l || (e.plotX = k[m][0] - b.plotLeft + b.diffX, e.plotY = k[m][1] - b.plotTop + b.diffY), e.marker = a.extend(e.marker, { radius: g, width: 2 * g, height: 2 * g }));
                    l && this.deferLayout();
                }, checkOverlap: function (a, b) { var d = a[0] - b[0], c = a[1] - b[1]; return -.001 > Math.sqrt(d * d + c * c) - Math.abs(a[2] + b[2]); }, positionBubble: function (a, b, c) {
                    var d = Math.sqrt, f = Math.asin, e = Math.acos, g = Math.pow, h = Math.abs, d = d(g(a[0] - b[0], 2) + g(a[1] - b[1], 2)), e = e((g(d, 2) + g(c[2] + b[2], 2) - g(c[2] + a[2], 2)) / (2 * (c[2] + b[2]) * d)), f = f(h(a[0] - b[0]) / d);
                    a = (0 > a[1] - b[1] ? 0 : Math.PI) + e + f * (0 > (a[0] - b[0]) * (a[1] - b[1]) ? 1 : -1);
                    return [b[0] + (b[2] + c[2]) * Math.sin(a), b[1] - (b[2] + c[2]) * Math.cos(a), c[2], c[3], c[4]];
                }, placeBubbles: function (a) {
                    var b = this.checkOverlap, d = this.positionBubble, c = [], f = 1, e = 0, g = 0, h;
                    h = [];
                    var l;
                    a = a.sort(function (a, b) { return b[2] - a[2]; });
                    if (1 === a.length)
                        h = [0, 0, a[0][0], a[0][1], a[0][2]];
                    else if (a.length) {
                        c.push([[0, 0, a[0][2], a[0][3], a[0][4]]]);
                        c.push([[0, 0 - a[1][2] - a[0][2], a[1][2], a[1][3], a[1][4]]]);
                        for (l = 2; l < a.length; l++)
                            a[l][2] = a[l][2] || 1, h = d(c[f][e], c[f - 1][g], a[l]), b(h, c[f][0]) ? (c.push([]), g = 0, c[f + 1].push(d(c[f][e], c[f][0], a[l])), f++ , e = 0) : 1 < f && c[f - 1][g + 1] && b(h, c[f - 1][g + 1]) ? (g++ , c[f].push(d(c[f][e], c[f - 1][g], a[l])), e++) : (e++ , c[f].push(h));
                        this.chart.stages = c;
                        this.chart.rawPositions = [].concat.apply([], c);
                        this.resizeRadius();
                        h = this.chart.rawPositions;
                    }
                    return h;
                }, resizeRadius: function () {
                    var a = this.chart, b = a.rawPositions, c = Math.min, f = Math.max, e = a.plotLeft, g = a.plotTop, h = a.plotHeight, l = a.plotWidth, t, p, x, w, r, z;
                    t = x = Number.POSITIVE_INFINITY;
                    p = w = Number.NEGATIVE_INFINITY;
                    for (z = 0; z < b.length; z++)
                        r = b[z][2], t = c(t, b[z][0] - r), p = f(p, b[z][0] + r), x = c(x, b[z][1] - r), w = f(w, b[z][1] + r);
                    z = [p - t, w - x];
                    c = c.apply([], [(l - e) / z[0], (h - g) / z[1]]);
                    if (1e-10 < Math.abs(c - 1)) {
                        for (z = 0; z < b.length; z++)
                            b[z][2] *= c;
                        this.placeBubbles(b);
                    }
                    else
                        a.diffY = h / 2 + g - x - (w - x) / 2, a.diffX = l / 2 + e - t - (p - t) / 2;
                }, calculateZExtremes: function () {
                    var d = this.options.zMin, c = this.options.zMax, f = Infinity, e = -Infinity;
                    if (d && c)
                        return [d, c];
                    this.chart.series.forEach(function (b) { b.yData.forEach(function (b) { a.defined(b) && (b > e && (e = b), b < f && (f = b)); }); });
                    d = b(d, f);
                    c = b(c, e);
                    return [d, c];
                }, getPointRadius: function () {
                    var a = this, b = a.chart, c = a.options, f = c.useSimulation, e = Math.min(b.plotWidth, b.plotHeight), g = {}, h = [], l = b.allDataPoints, t, p, x, w, r;
                    ["minSize", "maxSize"].forEach(function (a) { var b = parseInt(c[a], 10), d = /%$/.test(c[a]); g[a] = d ? e * b / 100 : b * Math.sqrt(l.length); });
                    b.minRadius = t = g.minSize /
                        Math.sqrt(l.length);
                    b.maxRadius = p = g.maxSize / Math.sqrt(l.length);
                    r = f ? a.calculateZExtremes() : [t, p];
                    (l || []).forEach(function (b, c) { x = f ? Math.max(Math.min(b[2], r[1]), r[0]) : b[2]; w = a.getRadius(r[0], r[1], t, p, x); 0 === w && (w = null); l[c][2] = w; h.push(w); });
                    a.radii = h;
                }, redrawHalo: x.redrawHalo, onMouseDown: x.onMouseDown, onMouseMove: x.onMouseMove, onMouseUp: function (b) {
                    if (b.fixedPosition && !b.removed) {
                        var c, d, f = this.layout, e = this.parentNodeLayout;
                        e && f.options.dragBetweenSeries && e.nodes.forEach(function (e) {
                            b && b.marker && e !==
                                b.series.parentNode && (c = f.getDistXY(b, e), d = f.vectorLength(c) - e.marker.radius - b.marker.radius, 0 > d && (e.series.addPoint(a.merge(b.options, { plotX: b.plotX, plotY: b.plotY }), !1), f.removeNode(b), b.remove()));
                        });
                        x.onMouseUp.apply(this, arguments);
                    }
                }, destroy: function () { this.parentNode && (this.parentNodeLayout.removeNode(this.parentNode), this.parentNode.dataLabel && (this.parentNode.dataLabel = this.parentNode.dataLabel.destroy())); a.Series.prototype.destroy.apply(this, arguments); }, alignDataLabel: a.Series.prototype.alignDataLabel
                }, { destroy: function () { this.series.layout && this.series.layout.removeNode(this); return e.prototype.destroy.apply(this, arguments); } });
            g(f, "beforeRedraw", function () { this.allDataPoints && delete this.allDataPoints; });
        });
        y(r, "parts-more/Polar.js", [r["parts/Globals.js"]], function (a) {
            var p = a.pick, l = a.Series, e = a.seriesTypes, h = a.wrap, b = l.prototype, g = a.Pointer.prototype;
            b.searchPointByAngle = function (a) {
                var b = this.chart, f = this.xAxis.pane.center;
                return this.searchKDTree({
                clientX: 180 + -180 / Math.PI * Math.atan2(a.chartX -
                    f[0] - b.plotLeft, a.chartY - f[1] - b.plotTop)
                });
            };
            b.getConnectors = function (a, b, e, g) {
                var c, d, f, h, l, t, k, m;
                d = g ? 1 : 0;
                c = 0 <= b && b <= a.length - 1 ? b : 0 > b ? a.length - 1 + b : 0;
                b = 0 > c - 1 ? a.length - (1 + d) : c - 1;
                d = c + 1 > a.length - 1 ? d : c + 1;
                f = a[b];
                d = a[d];
                h = f.plotX;
                f = f.plotY;
                l = d.plotX;
                t = d.plotY;
                d = a[c].plotX;
                c = a[c].plotY;
                h = (1.5 * d + h) / 2.5;
                f = (1.5 * c + f) / 2.5;
                l = (1.5 * d + l) / 2.5;
                k = (1.5 * c + t) / 2.5;
                t = Math.sqrt(Math.pow(h - d, 2) + Math.pow(f - c, 2));
                m = Math.sqrt(Math.pow(l - d, 2) + Math.pow(k - c, 2));
                h = Math.atan2(f - c, h - d);
                k = Math.PI / 2 + (h + Math.atan2(k - c, l - d)) / 2;
                Math.abs(h -
                    k) > Math.PI / 2 && (k -= Math.PI);
                h = d + Math.cos(k) * t;
                f = c + Math.sin(k) * t;
                l = d + Math.cos(Math.PI + k) * m;
                k = c + Math.sin(Math.PI + k) * m;
                d = { rightContX: l, rightContY: k, leftContX: h, leftContY: f, plotX: d, plotY: c };
                e && (d.prevPointCont = this.getConnectors(a, b, !1, g));
                return d;
            };
            b.toXY = function (a) {
                var b, f = this.chart, e = a.plotX;
                b = a.plotY;
                a.rectPlotX = e;
                a.rectPlotY = b;
                b = this.xAxis.postTranslate(a.plotX, this.yAxis.len - b);
                a.plotX = a.polarPlotX = b.x - f.plotLeft;
                a.plotY = a.polarPlotY = b.y - f.plotTop;
                this.kdByAngle ? (f = (e / Math.PI * 180 + this.xAxis.pane.options.startAngle) %
                    360, 0 > f && (f += 360), a.clientX = f) : a.clientX = a.plotX;
            };
            e.spline && (h(e.spline.prototype, "getPointSpline", function (a, b, e, g) { this.chart.polar ? g ? (a = this.getConnectors(b, g, !0, this.connectEnds), a = ["C", a.prevPointCont.rightContX, a.prevPointCont.rightContY, a.leftContX, a.leftContY, a.plotX, a.plotY]) : a = ["M", e.plotX, e.plotY] : a = a.call(this, b, e, g); return a; }), e.areasplinerange && (e.areasplinerange.prototype.getPointSpline = e.spline.prototype.getPointSpline));
            a.addEvent(l, "afterTranslate", function () {
                var b = this.chart, c, e;
                if (b.polar) {
                    (this.kdByAngle = b.tooltip && b.tooltip.shared) ? this.searchPoint = this.searchPointByAngle : this.options.findNearestPointBy = "xy";
                    if (!this.preventPostTranslate)
                        for (c = this.points, e = c.length; e--;)
                            this.toXY(c[e]), !b.hasParallelCoordinates && !this.yAxis.reversed && c[e].y < this.yAxis.min && (c[e].isNull = !0);
                    this.hasClipCircleSetter || (this.hasClipCircleSetter = !!a.addEvent(this, "afterRender", function () {
                        var c;
                        b.polar && (c = this.yAxis.center, this.group.clip(b.renderer.clipCircle(c[0], c[1], c[2] / 2)), this.setClip =
                            a.noop);
                    }));
                }
            }, { order: 2 });
            h(b, "getGraphPath", function (a, b) {
            var c = this, f, e, d; if (this.chart.polar) {
                b = b || this.points;
                for (f = 0; f < b.length; f++)
                    if (!b[f].isNull) {
                        e = f;
                        break;
                    }
                !1 !== this.options.connectEnds && void 0 !== e && (this.connectEnds = !0, b.splice(b.length, 0, b[e]), d = !0);
                b.forEach(function (a) { void 0 === a.polarPlotY && c.toXY(a); });
            } f = a.apply(this, [].slice.call(arguments, 1)); d && b.pop(); return f;
            });
            l = function (a, b) {
                var c = this.chart, f = this.options.animation, e = this.group, d = this.markerGroup, g = this.xAxis.center, h = c.plotLeft, l = c.plotTop;
                c.polar ? c.renderer.isSVG && (!0 === f && (f = {}), b ? (a = { translateX: g[0] + h, translateY: g[1] + l, scaleX: .001, scaleY: .001 }, e.attr(a), d && d.attr(a)) : (a = { translateX: h, translateY: l, scaleX: 1, scaleY: 1 }, e.animate(a, f), d && d.animate(a, f), this.animate = null)) : a.call(this, b);
            };
            h(b, "animate", l);
            e.column && (e = e.column.prototype, e.polarArc = function (a, b, e, g) { var c = this.xAxis.center, d = this.yAxis.len; return this.chart.renderer.symbols.arc(c[0], c[1], d - b, null, { start: e, end: g, innerR: d - p(a, d) }); }, h(e, "animate", l), h(e, "translate", function (a) {
            var b = this.xAxis, f = b.startAngleRad, e, g, d; this.preventPostTranslate = !0; a.call(this); if (b.isRadial)
                for (e = this.points, d = e.length; d--;)
                    g = e[d], a = g.barX + f, g.shapeType = "path", g.shapeArgs = { d: this.polarArc(g.yBottom, g.plotY, a, a + g.pointWidth) }, this.toXY(g), g.tooltipPos = [g.plotX, g.plotY], g.ttBelow = g.plotY > b.center[1];
            }), h(e, "alignDataLabel", function (a, c, e, g, h, d) {
                this.chart.polar ? (a = c.rectPlotX / Math.PI * 180, null === g.align && (g.align = 20 < a && 160 > a ? "left" : 200 < a && 340 > a ? "right" : "center"), null === g.verticalAlign &&
                    (g.verticalAlign = 45 > a || 315 < a ? "bottom" : 135 < a && 225 > a ? "top" : "middle"), b.alignDataLabel.call(this, c, e, g, h, d)) : a.call(this, c, e, g, h, d);
            }));
            h(g, "getCoordinates", function (a, b) { var c = this.chart, e = { xAxis: [], yAxis: [] }; c.polar ? c.axes.forEach(function (a) { var d = a.isXAxis, f = a.center, g = b.chartX - f[0] - c.plotLeft, f = b.chartY - f[1] - c.plotTop; e[d ? "xAxis" : "yAxis"].push({ axis: a, value: a.translate(d ? Math.PI - Math.atan2(g, f) : Math.sqrt(Math.pow(g, 2) + Math.pow(f, 2)), !0) }); }) : e = a.call(this, b); return e; });
            a.SVGRenderer.prototype.clipCircle =
                function (b, c, e) { var f = a.uniqueKey(), g = this.createElement("clipPath").attr({ id: f }).add(this.defs); b = this.circle(b, c, e).add(g); b.id = f; b.clipPath = g; return b; };
            a.addEvent(a.Chart, "getAxes", function () { this.pane || (this.pane = []); a.splat(this.options.pane).forEach(function (b) { new a.Pane(b, this); }, this); });
            a.addEvent(a.Chart, "afterDrawChartBox", function () { this.pane.forEach(function (a) { a.render(); }); });
            h(a.Chart.prototype, "get", function (b, c) {
                return a.find(this.pane, function (a) { return a.options.id === c; }) || b.call(this, c);
            });
        });
        y(r, "masters/highcharts-more.src.js", [], function () { });
    });
}
//# sourceMappingURL=highcharts-more.js.map