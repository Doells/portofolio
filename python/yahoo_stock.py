import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from statsmodels.tsa.statespace.sarimax import SARIMAX
from sklearn.metrics import mean_squared_error

# Load the dataset
file_path = 'C:/Users/DOELLS/Desktop/portofolio/python/yahoo_stock.csv'  # Replace this with the path to your file
data = pd.read_csv(file_path)

# Convert 'Date' column to datetime format
data['Date'] = pd.to_datetime(data['Date'])

# Set 'Date' as the index of the DataFrame
data.set_index('Date', inplace=True)

# Check for missing values
if data.isnull().sum().any():
    print("Data contains missing values.")
else:
    print("No missing values in the dataset.")

# Split the data into training and testing sets
train_size = int(len(data) * 0.7)  # 70% training data, 30% test data
train_data = data[:train_size]
test_data = data[train_size:]

# We will use the 'Close' price for forecasting
train_close = train_data['Close']
test_close = test_data['Close']

# Function to calculate RMSE
def calculate_rmse(y_true, y_pred):
    return np.sqrt(mean_squared_error(y_true, y_pred))

# Hyperparameter grid for SARIMAX (p, d, q) and seasonal (P, D, Q, s)
p_values = [0, 1, 2]
d_values = [0, 1]
q_values = [0, 1, 2]
P_values = [0, 1]
D_values = [0, 1]
Q_values = [0, 1]
s_values = [5, 7, 12]  # Common seasonal periods, e.g., 5 days (week), 7 days (week), 12 months

best_rmse = float('inf')
best_model = None
best_params = None

# Grid search for optimal parameters
for p in p_values:
    for d in d_values:
        for q in q_values:
            for P in P_values:
                for D in D_values:
                    for Q in Q_values:
                        for s in s_values:
                            try:
                                # Fit SARIMAX model with current set of hyperparameters
                                model = SARIMAX(train_close, order=(p, d, q), seasonal_order=(P, D, Q, s))
                                model_fitted = model.fit(disp=False)
                                
                                # Forecasting the next set of values for validation (test set)
                                forecast = model_fitted.get_forecast(steps=len(test_close))
                                forecast_mean = forecast.predicted_mean

                                # Calculate RMSE
                                rmse = calculate_rmse(test_close, forecast_mean)
                                print(f"Evaluating SARIMAX({p},{d},{q}) x ({P},{D},{Q},{s}) - RMSE: {rmse}")

                                # Update best model if current one is better
                                if rmse < best_rmse:
                                    best_rmse = rmse
                                    best_model = model_fitted
                                    best_params = (p, d, q, P, D, Q, s)

                            except Exception as e:
                                print(f"Error fitting SARIMAX({p},{d},{q}) x ({P},{D},{Q},{s}): {e}")

# Display the best parameters and RMSE
print(f"Best SARIMAX Model: {best_params} with RMSE: {best_rmse}")

# Now use the best model for forecasting and plotting
forecast = best_model.get_forecast(steps=len(test_close))
forecast_mean = forecast.predicted_mean

# Plot the actual vs predicted values for the test set
plt.figure(figsize=(10, 6))
plt.plot(test_close, label='Actual', color='blue')
plt.plot(forecast_mean, label='Predicted', color='red')
plt.title('SARIMAX Forecast vs Actual (Test Set)')
plt.xlabel('Date')
plt.ylabel('Stock Close Price')
plt.legend()
plt.show()
