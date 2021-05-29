try:
    #Importación de las líbrerias necesarias
    #Import of the necessary libraries
    from pandas import DataFrame
    from fbprophet import Prophet
    from sklearn.metrics import mean_squared_error, r2_score, mean_absolute_error
    from numpy import arange
    from scipy.optimize import curve_fit
    import numpy as np

    #Definir la ecuación polinómica
    #Define the polynomial equation
    def objective(x, a, b, c):
	    return a * x + b * x**2 + c

    #Cargar los datos que PHP envía
    #Load the data that PHP sent us
    with open('pesos.txt', 'r') as file:
        brewDataStr = file.read()
    with open('instances.txt', 'r') as file:
        instancesStr = file.read()
    brewDataS = brewDataStr.split(';')
    instances = instancesStr.split(';')

    #Cargar los datos iniciales
    #Load the initial data
    x = np.linspace(1, len(instances), len(instances))
    y = np.array(brewDataS, dtype=np.float)
    #Ajuste de curva
    #Curve fitting
    popt, _ = curve_fit(objective, x, y)
    #Definir los valores de los parámetros de la ecuación polinómica
    #Summarize the parameter values of the polynomial equation
    a, b, c = popt
    #Definir una secuencia de entradas entre las entradas más pequeñas y más grandes conocidas
    #Define a sequence of inputs between the smallest and largest known inputs
    x_line = arange(min(x), max(x), 1)
    #Calcular los pesos con el ajuste de curva
    #Calculate the weights with the curve fitting
    y_line = objective(x_line, a, b, c)
    y_line = list(y_line)

    #Generar el fichero con los pesos con el ajuste de curva
    #Generate the file with the weights with the curve fitting
    pesosFitStr = ';'.join(str(e) for e in y_line)
    pesosFit = open("pesosFit.txt", "w")
    pesosFit.write(pesosFitStr)
    pesosFit.close()

    #Generar dataframe con la variación de los pesos por fecha de un registro
    #Generate dataframe with the variation of the weights by date of a record
    instances.pop()
    data = {"ds": instances, "y": y_line}
    df = DataFrame(data)

    #Generar los siguientes 365 pesos mediante una predicción con Prophet y con una frecuencia de milisegundos
    #Generate the next 365 weights through a prediction with Prophet and with a frequency of milliseconds
    m = Prophet(daily_seasonality=False, weekly_seasonality=False, yearly_seasonality=False).fit(df)
    future = m.make_future_dataframe(periods=round(len(df)*0.3), freq='S')
    forecast = m.predict(future)

    #Generar los ficheros con la predicción
    #Generate prediction files
    forecast[['ds', 'yhat']]

    yhat_column = forecast.loc[:, 'yhat']
    brewDataSArray = yhat_column.values
    brewDataSArray = brewDataSArray[len(df):(len(df)+(round(len(df)*0.3)))]

    ds_column = forecast.loc[:, 'ds']
    instancesArray = ds_column.values
    instancesArray = instancesArray[len(df):(len(df)+(round(len(df)*0.3)))]

    brewDataSstr = ';'.join(str(e) for e in brewDataSArray)
    pesosProphet = open("pesosProphet.txt", "w")
    pesosProphet.write(brewDataSstr)
    pesosProphet.close()

    instancesstr = ';'.join(str(e) for e in instancesArray)
    instancesProphet = open("instancesProphet.txt", "w")
    instancesProphet.write(instancesstr)
    instancesProphet.close()

    #Calcular R al cuadrado, MSE, MAE y RMSE
    #Calculate R-Squared, MSE, MAE and RMSE
    df.dropna(inplace=True)
    forecast2 = forecast[0:len(df)]
    dataProphetstr = str(len(df)) + ';' + str(round(len(df)*0.3)) + ';' + str(r2_score(df.y, forecast2.yhat)) + ';' + str(mean_squared_error(df.y, forecast2.yhat)) + ';' + str(mean_absolute_error(df.y, forecast2.yhat)) + ';' + str(np.sqrt(mean_squared_error(df.y, forecast2.yhat)))
    dataProphet = open("dataProphet.txt", "w")
    dataProphet.write(dataProphetstr)
    dataProphet.close()

except Exception as e:
    print(e)