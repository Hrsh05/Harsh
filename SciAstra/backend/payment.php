<!-- payment.php -->
<h3>Payment Options</h3>
<form action="payment-process.php" method="POST">
    <label for="paymentMethod">Choose Payment Method:</label>
    <select name="paymentMethod" id="paymentMethod">
        <option value="credit_card">Credit Card</option>
        <option value="debit_card">Debit Card</option>
        <option value="upi">UPI</option>
    </select>

    <button type="submit">Proceed to Pay</button>
</form>
