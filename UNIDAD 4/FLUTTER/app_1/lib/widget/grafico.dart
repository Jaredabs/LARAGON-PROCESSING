import 'package:flutter/material.dart';
import 'dart:convert';
import 'dart:async';
import 'package:http/http.dart' as http;
import 'package:fl_chart/fl_chart.dart';

class Grafico extends StatefulWidget {
  const Grafico({super.key});

  @override
  State<StatefulWidget> createState() {
    return Clase();
  }
}

class Clase extends State<Grafico> {
  List<double> datosGrafica = [];
  bool cargando = true;
  Timer? timer;

  void initState() {
    super.initState();
    obtenerDatos();
    timer = Timer.periodic(const Duration(seconds: 3), (timer) {
      obtenerDatos();
    });
  }

  @override
  void dispose() {
    timer?.cancel();
    super.dispose();
  }

  Future obtenerDatos() async {
    try {
      final url = Uri.parse("http://192.168.16.197:8000/api/sensores");
      final respuesta = await http.get(url).timeout(const Duration(seconds: 3));
      if (respuesta.statusCode == 200) {
        final dynamic datos = json.decode(respuesta.body);
        if (datos is List) {
          setState(() {
            final todosdatos = datos.map<double>((item) {
              if (item is num) return item.toDouble();
              return double.tryParse(item.toString()) ??
                  0.0; //trata de convertir el dato a String y si no puede lo vuelve a 0.0
            }).toList();
            datosGrafica = todosdatos.length > 10
                ? todosdatos.sublist(todosdatos.length - 5)
                : todosdatos;
            cargando = false;
          });
        }
      }
    } catch (e) {
      print('Error:$e');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Graficas',
            style: TextStyle(
              color: Colors.white,
            )),
        backgroundColor: const Color.fromARGB(255, 255, 0, 0),
      ),
      body: cargando
          ? Center(child: CircularProgressIndicator())
          : Padding(
              padding: EdgeInsets.all(10),
              child: Column(
                children: [
                  Card(
                    elevation: 15,
                    child: Padding(
                      padding: EdgeInsets.all(5),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
                            children: [
                              Text("Datos a Graficar"),
                              Text(" ${datosGrafica.length}"),
                            ],
                          ),
                          SizedBox(
                            width: 8,
                          ),
                          Column(
                            children: [
                              Text("Ultimo Dato"),
                              Text(
                                  "${datosGrafica.isNotEmpty ? datosGrafica.last.toStringAsFixed(1) : '0'}"),
                            ],
                          ),
                          SizedBox(
                            width: 8,
                          ),
                          Column(
                            children: [
                              Text("Primer Dato"),
                              Text(
                                  "${datosGrafica.isNotEmpty ? datosGrafica.first.toStringAsFixed(1) : '0'}"),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ),
                  //debajo del Card
                  Expanded(
                    child: BarChart(
                      BarChartData(
                        minY: 0,
                        maxY: datosGrafica.isNotEmpty
                            ? datosGrafica.reduce((a, b) => a > b ? a : b) * 1.2
                            : 100,
                        barGroups: datosGrafica.asMap().entries.map((entry) {
                          final indice = entry.key;
                          final valor = entry.value;
                          return BarChartGroupData(x: indice, barRods: [
                            BarChartRodData(
                                toY: valor,
                                color: Colors.amberAccent,
                                width: 15,
                                borderRadius: BorderRadius.circular(15))
                          ]);
                        }).toList(),
                        titlesData: FlTitlesData(
                            bottomTitles: AxisTitles(
                              sideTitles: SideTitles(
                                showTitles: true,
                                getTitlesWidget: (value, meta) {
                                  return Text('${value.toInt() + 1}');
                                },
                              ),
                            ),
                            leftTitles: AxisTitles(
                                sideTitles: SideTitles(
                              showTitles: true,
                              getTitlesWidget: (value, meta) {
                                return Text('${value.toInt()}');
                              },
                            ))),
                        gridData: FlGridData(show: true),
                        borderData: FlBorderData(show: true),
                      ),
                    ),
                  ),
                  Expanded(
                    child: BarChart(
                      BarChartData(
                        minY: 0,
                        maxY: datosGrafica.isNotEmpty
                            ? datosGrafica.reduce((a, b) => a > b ? a : b) * 1.2
                            : 100,
                        barGroups: datosGrafica.asMap().entries.map((entry) {
                          final indice = entry.key;
                          final valor = entry.value;
                          return BarChartGroupData(x: indice, barRods: [
                            BarChartRodData(
                                toY: valor,
                                color: Colors.amberAccent,
                                width: 15,
                                borderRadius: BorderRadius.circular(15))
                          ]);
                        }).toList(),
                        titlesData: FlTitlesData(
                            bottomTitles: AxisTitles(
                              sideTitles: SideTitles(
                                showTitles: true,
                                getTitlesWidget: (value, meta) {
                                  return Text('${value.toInt() + 1}');
                                },
                              ),
                            ),
                            leftTitles: AxisTitles(
                                sideTitles: SideTitles(
                              showTitles: true,
                              getTitlesWidget: (value, meta) {
                                return Text('${value.toInt()}');
                              },
                            ))),
                        gridData: FlGridData(show: true),
                        borderData: FlBorderData(show: true),
                      ),
                    ),
                  ),
                ],
              ),
            ),
    );
  }
}
