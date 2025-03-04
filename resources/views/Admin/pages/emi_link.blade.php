@if($emi_link && $emi_link->status == 1)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMI and Loan Eligibility Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #000000;
            --card-dark: #0a0a0a;
            --text-light: #f0f0f0;
            --primary: #00ff7f;
            --secondary: #8a2be2;
            --editable-bg: #ffff00;
            --editable-text: #1b96ff;
            --non-editable-bg: linear-gradient(135deg, #1a1a1a, #0a0a0a);
            --shadow: 0 8px 28px rgba(0, 255, 127, 0.3);
            --tab-bg: #ffffff;
            --tab-text: #1b96ff;
            --tab-active-bg: #ffff00;
            --tab-container-bg: #000000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-size: 20px;
            line-height: 1.6;
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
            overflow-x: hidden;
        }

        .calculator {
            background: var(--card-dark);
            padding: 40px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0, 255, 127, 0.1);
            position: relative;
        }

        .tabs {
            display: flex;
            background: var(--tab-container-bg);
            border-radius: 14px;
            margin-bottom: 35px;
            padding: 10px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            gap: 10px;
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 18px;
            cursor: pointer;
            font-weight: 700;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s ease;
            color: var(--tab-text);
            background: var(--tab-bg);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .tab:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
        }

        .tab.active {
            background: var(--tab-active-bg);
            color: var(--tab-text);
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 20px rgba(255, 255, 0, 0.6), 0 0 15px rgba(0, 255, 127, 0.3);
        }

        .tab-content {
            display: none;
            animation: slideIn 0.5s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes slideIn {
            0% { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        .input-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input, select {
            width: 100%;
            padding: 16px 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            font-size: 22px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-light);
        }

        input:not([readonly]), select {
            background: var(--editable-bg);
            color: var(--editable-text);
            border-color: var(--primary);
            font-weight: 800;
            font-size: 24px;
        }

        input:not([readonly]):focus, select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 15px rgba(138, 43, 226, 0.5);
        }

        input[readonly] {
            background: var(--non-editable-bg);
            color: var(--text-light);
            border: 2px solid rgba(0, 255, 127, 0.2);
            cursor: not-allowed;
            font-weight: 600;
            text-shadow: 0 0 5px rgba(0, 255, 127, 0.5);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3), inset 0 0 5px rgba(0, 255, 127, 0.2);
            transform: perspective(500px) translateZ(5px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        input[readonly]:hover {
            transform: perspective(500px) translateZ(10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4), inset 0 0 8px rgba(0, 255, 127, 0.3);
        }

        select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="%23f0f0f0" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 20px center;
            padding-right: 45px;
        }

        select option {
            background: var(--card-dark);
            color: var(--text-light);
            font-size: 20px;
            font-weight: 700;
        }

        button {
            background: var(--primary);
            color: #000;
            padding: 16px 30px;
            border: none;
            border-radius: 10px;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            position: relative;
        }

        button:hover {
            background: #33ff99;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 36px rgba(0, 255, 127, 0.5);
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% { transform: translateY(-3px) scale(1.02); }
            50% { transform: translateY(-3px) scale(1.05); }
            100% { transform: translateY(-3px) scale(1.02); }
        }

        .part-payments {
            margin: 25px 0;
        }

        .part-payment {
            display: grid;
            grid-template-columns: 1fr 1fr 60px;
            gap: 15px;
            margin-bottom: 15px;
            align-items: center;
        }

        .delete-btn {
            background: transparent;
            border: none;
            color: var(--secondary);
            font-size: 26px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .delete-btn:hover {
            color: #ff4081;
            transform: scale(1.2);
        }

        .results {
            margin-top: 35px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            border: 1px solid rgba(0, 255, 127, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        .result-item {
            margin: 15px 0;
            font-size: 20px;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .result-item span {
            color: var(--primary);
            font-weight: 600;
        }

        .profit {
            background: linear-gradient(135deg, #004d40, #00c853);
            color: var(--text-light);
            padding: 18px;
            border-radius: 10px;
            margin: 20px 0;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .profit span {
            color: #f0f0f0;
        }

        .schedule-section {
            margin-top: 35px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            padding: 0 20px;
            border: 1px solid rgba(0, 255, 127, 0.1);
        }

        .schedule-section.active {
            max-height: 400px; /* Fixed height for vertical scrolling */
            overflow: auto; /* Enables both horizontal and vertical scrolling */
            padding: 20px;
            animation: expand 0.5s ease-in-out;
        }

        @keyframes expand {
            0% { opacity: 0; max-height: 0; }
            100% { opacity: 1; max-height: 400px; }
        }

        table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
            font-size: 18px;
            color: var(--text-light);
            white-space: nowrap;
        }

        th, td {
            padding: 14px;
            text-align: right;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            background: var(--primary);
            color: #000;
            font-weight: 700;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .highlight-green {
            background: rgba(0, 200, 83, 0.2);
        }

        .loan-type-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .loan-type-buttons button {
            background: var(--secondary);
            color: var(--text-light);
        }

        .loan-type-buttons button.active {
            background: var(--primary);
            color: #000;
        }

        .foir-toggle {
            background: var(--secondary);
            color: var(--text-light);
            padding: 12px 22px;
            font-size: 18px;
            margin-left: 10px;
        }

        .foir-toggle.active {
            background: var(--primary);
            color: #000;
            box-shadow: 0 0 15px rgba(0, 255, 127, 0.6);
        }

        .foir-options {
            display: inline-block;
            margin-left: 10px;
        }

        .foir-options button {
            background: var(--secondary);
            color: var(--text-light);
            padding: 12px 22px;
            margin: 0 5px;
            font-size: 18px;
            border-radius: 8px;
        }

        .foir-options button.active {
            background: var(--primary);
            color: #000;
        }

        #eligibleAmountFOIR, #eligibleAmountMultiplier {
            font-size: 40px;
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            margin: 25px 0;
            animation: glow 1s ease-in-out infinite alternate;
        }

        @keyframes glow {
            0% { text-shadow: 0 0 10px rgba(0, 255, 127, 0.5); }
            100% { text-shadow: 0 0 20px rgba(0, 255, 127, 0.8); }
        }

        .comparison-text {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            margin: 25px 0;
            color: var(--text-light);
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--card-dark);
            padding: 35px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            z-index: 1000;
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            color: var(--text-light);
            border: 1px solid var(--primary);
            animation: popIn 0.5s ease-in-out;
        }

        @keyframes popIn {
            0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
        }

        .party-popper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1001;
            pointer-events: none;
            background: rgba(0, 0, 0, 0.7);
            animation: confettiBlast 2s ease-in-out forwards;
        }

        .party-popper::before {
            content: '🎉✨🎉✨🎉✨🎉✨🎉✨';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 60px;
            color: var(--primary);
            animation: sparkle 2s infinite;
            white-space: nowrap;
            width: 100%;
            text-align: center;
        }

        @keyframes confettiBlast {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }

        @keyframes sparkle {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.2); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }

        .sad-emoji {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1001;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            font-size: 120px;
            color: var(--secondary);
            animation: shakeFade 2s ease-in-out forwards;
        }

        @keyframes shakeFade {
            0% { opacity: 0; transform: scale(0.8); }
            20% { opacity: 1; transform: scale(1) rotate(5deg); }
            40% { transform: scale(1) rotate(-5deg); }
            60% { transform: scale(1) rotate(5deg); }
            80% { transform: scale(1) rotate(-5deg); }
            100% { opacity: 0; transform: scale(0.8); }
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .calculator {
                padding: 25px;
            }

            .tabs {
                flex-direction: column;
                padding: 8px;
            }

            .tab {
                padding: 14px;
                font-size: 20px;
            }

            .input-group {
                margin-bottom: 20px;
            }

            input, select {
                padding: 12px 16px;
                font-size: 18px;
            }

            input:not([readonly]), select {
                font-size: 20px;
            }

            button {
                padding: 12px 20px;
                font-size: 18px;
            }

            .part-payment {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .loan-type-buttons {
                grid-template-columns: 1fr;
            }

            .results {
                padding: 20px;
            }

            .result-item {
                flex-direction: column;
                text-align: center;
                gap: 8px;
                font-size: 18px;
            }

            #eligibleAmountFOIR, #eligibleAmountMultiplier {
                font-size: 32px;
            }

            .schedule-section.active {
                max-height: 300px; /* Adjusted for mobile */
                overflow: auto;
                -webkit-overflow-scrolling: touch;
            }

            table {
                min-width: 800px;
            }

            .party-popper::before {
                font-size: 40px;
            }

            .sad-emoji {
                font-size: 80px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <div class="calculator">
        <div class="tabs">
            <div class="tab active" onclick="switchTab('emiCalculator')">EMI Calculator</div>
            <div class="tab" onclick="switchTab('loanEligibilityCalculator')">Loan Eligibility Calculator</div>
        </div>

        <div id="emiCalculator" class="tab-content active">
            <div class="input-group">
                <label>Loan Amount</label>
                <input type="text" id="loanAmount" placeholder="₹">
            </div>
            <div class="input-group">
                <label>Tenure (Months)</label>
                <input type="text" id="tenureMonths" placeholder="Enter months">
            </div>
            <div class="input-group">
                <label>Tenure (Years)</label>
                <input type="text" id="tenureYears" placeholder="Years" readonly>
            </div>
            <div class="input-group">
                <label>Annual Interest Rate</label>
                <input type="text" id="interestRate" placeholder="Enter rate">
            </div>
            <div class="part-payments">
                <div id="partPaymentEntries"></div>
                <button onclick="addPartPaymentField()">Add Part Payment</button>
            </div>
            <button onclick="validateAndCalculateEMI()">Calculate EMI</button>
            <div class="results">
                <div class="result-item">
                    Monthly EMI: <span id="emiResult">₹0</span>
                </div>
                <div class="result-item">
                    Total Principal + Interest: <span id="totalRepayment">₹0</span>
                </div>
                <div class="result-item">
                    Total Interest Paid: <span id="totalInterest">₹0</span>
                </div>
                <div class="profit" id="interestSaving">
                    Interest Saved: <span>₹0</span>
                </div>
                <div class="result-item">
                    Loan Closure Month: <span id="loanClosure">0</span>
                </div>
                <div class="result-item">
                    Number of Part Payments: <span id="partPaymentCount">0</span>
                </div>
            </div>
            <button class="toggle-schedule" onclick="toggleSchedule()" style="display: none;">Show Repayment Schedule</button>
            <button onclick="generatePDF()" style="display: none; margin-left:10px;" id="pdfBtn">Download PDF</button>
            <div class="schedule-section" id="paymentSchedule">
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>EMI</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Part Payment</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody id="scheduleBody"></tbody>
                </table>
            </div>
        </div>

        <div id="loanEligibilityCalculator" class="tab-content">
            <div class="input-group">
                <label>Salary</label>
                <input type="text" id="salary" placeholder="₹">
            </div>
            <div class="input-group">
                <label>Company Category</label>
                <select id="companyCategory" onchange="resetFOIRAndCalculate()">
                    <option value="" disabled selected>Select Company Category</option>
                    <option value="SUPER_CAT_A">SUPER CAT A</option>
                    <option value="CAT_A">CAT A</option>
                    <option value="CAT_B">CAT B</option>
                    <option value="CAT_C">CAT C</option>
                    <option value="UNLISTED">UNLISTED COMPANY</option>
                </select>
                <span id="foirOptions" class="foir-options" style="display: none;">
                    <button onclick="selectFOIR(50)">50%</button>
                    <button onclick="selectFOIR(60)">60%</button>
                    <button onclick="selectFOIR(65)">65%</button>
                    <button onclick="selectFOIR(70)">70%</button>
                </span>
                <button class="foir-toggle" id="foirToggle" onclick="toggleFOIR()">5%</button>
            </div>
            <div class="input-group">
                <label>FOIR</label>
                <input type="text" id="foir" placeholder="FOIR %" readonly>
            </div>
            <div class="input-group">
                <label>EMI Can Pay As Per FOIR</label>
                <input type="text" id="emiCanPayFOIR" placeholder="₹" readonly>
            </div>
            <div class="input-group">
                <label>Obligation</label>
                <input type="text" id="obligation" placeholder="₹">
            </div>
            <div class="input-group">
                <label>Monthly EMI Can Pay</label>
                <input type="text" id="monthlyEmiCanPay" placeholder="₹" readonly>
            </div>
            <div class="loan-type-buttons">
                <button onclick="selectLoanType('fresh')" id="freshLoanBtn">Fresh Loan</button>
                <button onclick="selectLoanType('bt')" id="btLoanBtn">Balance Transfer Loan</button>
            </div>
            <div class="input-group" id="btAmountGroup" style="display: none;">
                <label>BT Amount</label>
                <input type="text" id="btAmount" placeholder="₹">
            </div>
            <div class="input-group">
                <label>Tenure (Months)</label>
                <input type="text" id="eligibilityTenureMonths" placeholder="Enter months">
            </div>
            <div class="input-group">
                <label>Tenure (Years)</label>
                <input type="text" id="eligibilityTenureYears" placeholder="Years" readonly>
            </div>
            <div class="input-group">
                <label>Annual Interest Rate</label>
                <input type="text" id="eligibilityInterestRate" placeholder="Enter rate">
            </div>
            <button onclick="calculateLoanAmount()">Calculate Loan Amount</button>
            <div class="results">
                <div class="result-item">
                    Eligible Amount as FOIR: <span id="eligibleAmountFOIR">₹0</span>
                </div>
                <div class="comparison-text">Will Get Whichever is Lower</div>
                <div class="result-item">
                    Eligible Amount as MULTIPLIER: <span id="eligibleAmountMultiplier"></span>
                </div>
                <div class="input-group">
                    <label>Multiplier</label>
                    <input type="text" id="multiplier" placeholder="Enter number (max 35)">
                </div>
            </div>
        </div>
    </div>

    <div id="popup" class="popup" style="display: none;">
        <div id="popupMessage"></div>
        <button onclick="closePopup()">OK</button>
    </div>

    <div id="partyPopper" class="party-popper" style="display: none;"></div>
    <div id="sadEmoji" class="sad-emoji" style="display: none;">😢</div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
            document.querySelector(`[onclick="switchTab('${tabName}')"]`).classList.add('active');
        }

        function formatCurrencyWithCommas(value) {
            return '₹' + Math.round(Number(value)).toLocaleString('en-IN');
        }

        function parseCurrency(str) {
            return parseFloat(str.replace(/[^0-9.]/g, '')) || 0;
        }

        function resetFOIRResults() {
            document.getElementById('eligibleAmountFOIR').textContent = '₹0';
        }

        function updateMultiplierResult() {
            const salary = parseCurrency(document.getElementById('salary').value);
            const obligation = parseCurrency(document.getElementById('obligation').value);
            const multiplier = parseInt(document.getElementById('multiplier').value) || 0;
            const result = (salary - obligation) * multiplier;
            if (multiplier > 0 && result > 0) {
                document.getElementById('eligibleAmountMultiplier').textContent = formatCurrencyWithCommas(result);
            } else {
                document.getElementById('eligibleAmountMultiplier').textContent = '';
            }
        }

        document.getElementById('salary').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) value = formatCurrencyWithCommas(value);
            e.target.value = value;
            calculateFOIR();
            resetFOIRResults();
            updateMultiplierResult();
        });

        document.getElementById('obligation').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) value = formatCurrencyWithCommas(value);
            e.target.value = value;
            calculateMonthlyEMICanPay();
            resetFOIRResults();
            updateMultiplierResult();
        });

        document.getElementById('btAmount').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) value = formatCurrencyWithCommas(value);
            e.target.value = value;
            resetFOIRResults();
        });

        document.getElementById('tenureMonths').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) {
                e.target.value = value + ' Months';
                const months = parseInt(value);
                const years = (months / 12).toFixed(1);
                document.getElementById('tenureYears').value = years + ' Years';
            } else {
                e.target.value = '';
                document.getElementById('tenureYears').value = '';
            }
        });

        document.getElementById('eligibilityTenureMonths').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) {
                e.target.value = value + ' Months';
                const months = parseInt(value);
                const years = (months / 12).toFixed(1);
                document.getElementById('eligibilityTenureYears').value = years + ' Years';
            } else {
                e.target.value = '';
                document.getElementById('eligibilityTenureYears').value = '';
            }
            resetFOIRResults();
        });

        document.getElementById('eligibilityInterestRate').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            if (value) {
                if (parseFloat(value) > 50) value = '50';
                e.target.value = value + '%';
            }
            resetFOIRResults();
        });

        document.getElementById('interestRate').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            if (value) {
                if (parseFloat(value) > 50) value = '50';
                e.target.value = value + '%';
            }
        });

        document.getElementById('multiplier').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) {
                const num = parseInt(value);
                if (num > 35) {
                    showPopup('Multiplier cannot be greater than 35');
                    e.target.value = '35';
                } else {
                    e.target.value = value;
                }
                updateMultiplierResult();
            } else {
                document.getElementById('eligibleAmountMultiplier').textContent = '';
            }
        });

        function resetFOIRAndCalculate() {
            const foirToggle = document.getElementById('foirToggle');
            const foirOptions = document.getElementById('foirOptions');
            const companyCategory = document.getElementById('companyCategory').value;

            if (companyCategory === 'UNLISTED') {
                foirToggle.style.display = 'none';
                foirOptions.style.display = 'inline-block';
                document.querySelectorAll('.foir-options button').forEach(btn => btn.classList.remove('active'));
            } else {
                foirToggle.style.display = 'inline-block';
                foirToggle.classList.remove('active');
                foirOptions.style.display = 'none';
            }
            
            calculateFOIR();
            resetFOIRResults();
            updateMultiplierResult();
        }

        function calculateFOIR() {
            const salary = parseCurrency(document.getElementById('salary').value);
            const companyCategory = document.getElementById('companyCategory').value;

            if (!salary || !companyCategory) {
                document.getElementById('foir').value = '';
                document.getElementById('emiCanPayFOIR').value = '';
                document.getElementById('monthlyEmiCanPay').value = '';
                return;
            }

            if (companyCategory === 'UNLISTED' && !document.getElementById('foir').value) {
                return;
            }

            let foir = 0;

            if (companyCategory !== 'UNLISTED') {
                if (companyCategory === 'SUPER_CAT_A' || companyCategory === 'CAT_A' || companyCategory === 'CAT_B') {
                    if (salary >= 0 && salary <= 34999) foir = 50;
                    else if (salary >= 35000 && salary <= 49999) foir = 60;
                    else if (salary >= 50000 && salary <= 74999) foir = 65;
                    else if (salary >= 75000) foir = 70;
                } else if (companyCategory === 'CAT_C') {
                    if (salary >= 0 && salary <= 34999) foir = 45;
                    else if (salary >= 35000 && salary <= 49999) foir = 50;
                    else if (salary >= 50000 && salary <= 74999) foir = 60;
                    else if (salary >= 75000) foir = 70;
                }
                document.getElementById('foir').value = foir + '%';
            }

            calculateEMICanPayFOIR();
        }

        function selectFOIR(foir) {
            document.getElementById('foir').value = foir + '%';
            document.querySelectorAll('.foir-options button').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            calculateEMICanPayFOIR();
            resetFOIRResults();
            updateMultiplierResult();
        }

        function toggleFOIR() {
            const foirInput = document.getElementById('foir');
            const foirToggle = document.getElementById('foirToggle');
            let foir = parseFloat(foirInput.value.replace('%', ''));

            if (isNaN(foir)) return;

            if (foirToggle.classList.contains('active')) {
                foir -= 5;
                foirToggle.classList.remove('active');
            } else {
                foir += 5;
                foirToggle.classList.add('active');
            }

            foirInput.value = foir + '%';
            calculateEMICanPayFOIR();
            resetFOIRResults();
            updateMultiplierResult();
        }

        function calculateEMICanPayFOIR() {
            const salary = parseCurrency(document.getElementById('salary').value);
            const foir = parseFloat(document.getElementById('foir').value.replace('%', ''));

            if (!isNaN(salary) && !isNaN(foir)) {
                const emiCanPayFOIR = (salary * foir) / 100;
                document.getElementById('emiCanPayFOIR').value = formatCurrencyWithCommas(emiCanPayFOIR);
                calculateMonthlyEMICanPay();
            } else {
                document.getElementById('emiCanPayFOIR').value = '';
                document.getElementById('monthlyEmiCanPay').value = '';
            }
        }

        function calculateMonthlyEMICanPay() {
            const emiCanPayFOIR = parseCurrency(document.getElementById('emiCanPayFOIR').value) || 0;
            const obligation = parseCurrency(document.getElementById('obligation').value) || 0;
            const monthlyEmiCanPayInput = document.getElementById('monthlyEmiCanPay');

            let monthlyEmiCanPay = emiCanPayFOIR;
            if (obligation > 0) {
                monthlyEmiCanPay = emiCanPayFOIR - obligation;
            }

            if (monthlyEmiCanPay <= 0) {
                monthlyEmiCanPayInput.value = 'Not Eligible';
                monthlyEmiCanPayInput.style.backgroundColor = '#ff4444';
                monthlyEmiCanPayInput.style.color = '#fff';
            } else {
                monthlyEmiCanPayInput.value = formatCurrencyWithCommas(monthlyEmiCanPay);
                monthlyEmiCanPayInput.style.backgroundColor = '';
                monthlyEmiCanPayInput.style.color = '';
            }
        }

        function selectLoanType(type) {
            const freshLoanBtn = document.getElementById('freshLoanBtn');
            const btLoanBtn = document.getElementById('btLoanBtn');
            const btAmountGroup = document.getElementById('btAmountGroup');

            if (type === 'fresh') {
                freshLoanBtn.classList.add('active');
                btLoanBtn.classList.remove('active');
                btAmountGroup.style.display = 'none';
            } else if (type === 'bt') {
                btLoanBtn.classList.add('active');
                freshLoanBtn.classList.remove('active');
                btAmountGroup.style.display = 'block';
            }
            resetFOIRResults();
        }

        function showPopup(message) {
            const popup = document.getElementById('popup');
            const popupMessage = document.getElementById('popupMessage');
            popupMessage.textContent = message;
            popup.style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function showPartyPopper() {
            const partyPopper = document.getElementById('partyPopper');
            partyPopper.style.display = 'block';
            setTimeout(() => partyPopper.style.display = 'none', 2000);
        }

        function showSadEmoji() {
            const sadEmoji = document.getElementById('sadEmoji');
            sadEmoji.style.display = 'block';
            setTimeout(() => sadEmoji.style.display = 'none', 2000);
        }

        function calculateLoanAmount() {
            const freshLoanBtn = document.getElementById('freshLoanBtn');
            const btLoanBtn = document.getElementById('btLoanBtn');
            const btAmount = parseCurrency(document.getElementById('btAmount').value);

            if (!freshLoanBtn.classList.contains('active') && !btLoanBtn.classList.contains('active')) {
                showPopup('Please select case type: Fresh Loan or Balance Transfer');
                return;
            }

            if (btLoanBtn.classList.contains('active') && isNaN(btAmount)) {
                showPopup('Please enter BT Amount');
                return;
            }

            const monthlyEmiCanPay = parseCurrency(document.getElementById('monthlyEmiCanPay').value);
            const monthsStr = document.getElementById('eligibilityTenureMonths').value;
            const months = parseInt(monthsStr.replace(' Months', ''));
            const annualRate = parseFloat(document.getElementById('eligibilityInterestRate').value.replace('%', ''));

            if (isNaN(monthlyEmiCanPay) || isNaN(months) || isNaN(annualRate) || monthlyEmiCanPay <= 0 || months <= 0 || annualRate < 0 || annualRate > 50) {
                showPopup('Please enter valid values');
                return;
            }

            const monthlyRate = annualRate / 1200;
            const loanAmountFOIR = (monthlyEmiCanPay * (Math.pow(1 + monthlyRate, months) - 1)) / (monthlyRate * Math.pow(1 + monthlyRate, months));

            document.getElementById('eligibleAmountFOIR').textContent = formatCurrencyWithCommas(loanAmountFOIR);

            if (btLoanBtn.classList.contains('active')) {
                if (loanAmountFOIR < btAmount) {
                    showSadEmoji();
                    showPopup('Sorry, you are not eligible for balance transfer. Your loan eligibility is less than your BT amount.');
                } else {
                    showPartyPopper();
                    showPopup('Congratulations! You are eligible for the loan.');
                }
            } else {
                showPartyPopper();
                showPopup('Congratulations! You are eligible for the loan.');
            }
        }

        document.getElementById('loanAmount').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value) value = formatCurrencyWithCommas(value);
            e.target.value = value;
        });

        function addPartPaymentField() {
            const container = document.getElementById('partPaymentEntries');
            const div = document.createElement('div');
            div.className = 'part-payment';
            div.innerHTML = `
                <input type="text" placeholder="Month" class="partPaymentMonth">
                <input type="text" placeholder="Amount" class="partPaymentAmount">
                <button class="delete-btn" onclick="this.parentElement.remove()">✕</button>
            `;
            container.appendChild(div);

            div.querySelector('.partPaymentMonth').addEventListener('input', function(e) {
                const value = e.target.value.replace(/[^0-9]/g, '');
                if (value) {
                    const month = parseInt(value);
                    const ordinal = [, 'st', 'nd', 'rd'][(month % 100) > 20 ? month % 10 : month % 100] || 'th';
                    e.target.value = month + ordinal + ' month';
                }
            });

            div.querySelector('.partPaymentAmount').addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/g, '');
                if (value) value = formatCurrencyWithCommas(value);
                e.target.value = value;
            });
        }

        function toggleSchedule() {
            const schedule = document.getElementById('paymentSchedule');
            const btn = document.querySelector('.toggle-schedule');
            schedule.classList.toggle('active');
            btn.textContent = schedule.classList.contains('active') ? 'Hide Repayment Schedule' : 'Show Repayment Schedule';
        }

        function validateAndCalculateEMI() {
            const principal = parseCurrency(document.getElementById('loanAmount').value);
            const monthsStr = document.getElementById('tenureMonths').value;
            const months = parseInt(monthsStr.replace(' Months', ''));
            const annualRate = parseFloat(document.getElementById('interestRate').value.replace('%', ''));

            if (isNaN(principal) || isNaN(months) || isNaN(annualRate) || principal <= 0 || months <= 0 || annualRate < 0 || annualRate > 50) {
                showPopup('Please enter valid values');
                return;
            }

            const numMonths = months;
            const monthlyRate = annualRate / 1200;
            const emi = (principal * monthlyRate * Math.pow(1 + monthlyRate, numMonths)) / (Math.pow(1 + monthlyRate, numMonths) - 1);

            const partPayments = [];
            document.querySelectorAll('.part-payment').forEach(pp => {
                const month = parseInt(pp.querySelector('.partPaymentMonth').value);
                const amount = parseCurrency(pp.querySelector('.partPaymentAmount').value);
                if (!isNaN(month) && month > 0 && !isNaN(amount) && amount > 0) {
                    partPayments.push({ month, amount });
                }
            });

            let balance = principal;
            let totalInterest = 0;
            const schedule = [];
            const paymentMap = new Map(partPayments.map(pp => [pp.month, pp.amount]));
            let invalidPartPayment = false;

            for (let month = 1; month <= numMonths; month++) {
                const interest = balance * monthlyRate;
                const principalPaid = Math.min(emi - interest, balance);
                let partPayment = paymentMap.get(month) || 0;

                totalInterest += interest;
                if (partPayment > balance) {
                    invalidPartPayment = true;
                    showPopup(`Invalid part payment in month ${month}. Outstanding balance is ${formatCurrencyWithCommas(balance)}. You can only make a part payment up to this amount.`);
                    return;
                }
                balance -= (principalPaid + partPayment);

                schedule.push({
                    month,
                    emi: principalPaid + interest,
                    principal: principalPaid,
                    interest,
                    partPayment,
                    balance: Math.max(balance, 0)
                });

                if (balance <= 0) break;
            }

            if (!invalidPartPayment) {
                document.getElementById('emiResult').textContent = formatCurrencyWithCommas(emi);
                document.getElementById('totalRepayment').textContent = formatCurrencyWithCommas(principal + totalInterest);
                document.getElementById('totalInterest').textContent = formatCurrencyWithCommas(totalInterest);
                document.getElementById('loanClosure').textContent = schedule.length;
                document.getElementById('interestSaving').querySelector('span').textContent = formatCurrencyWithCommas((emi * numMonths - principal) - totalInterest);
                document.getElementById('partPaymentCount').textContent = partPayments.length;

                const scheduleBody = document.getElementById('scheduleBody');
                scheduleBody.innerHTML = '';
                schedule.forEach(entry => {
                    const row = document.createElement('tr');
                    if (entry.partPayment > 0) row.classList.add('highlight-green');
                    row.innerHTML = `
                        <td>${entry.month}</td>
                        <td>${formatCurrencyWithCommas(entry.emi)}</td>
                        <td>${formatCurrencyWithCommas(entry.principal)}</td>
                        <td>${formatCurrencyWithCommas(entry.interest)}</td>
                        <td>${entry.partPayment ? formatCurrencyWithCommas(entry.partPayment) : '-'}</td>
                        <td>${formatCurrencyWithCommas(entry.balance)}</td>
                    `;
                    scheduleBody.appendChild(row);
                });

                document.querySelector('.toggle-schedule').style.display = 'inline-block';
                document.getElementById('pdfBtn').style.display = 'inline-block';
            }
        }

        function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'pt', 'a4');
            doc.setFontSize(16);
            doc.setTextColor(255, 255, 255);
            doc.setFillColor(0, 0, 0);
            doc.rect(0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight(), 'F');
            doc.text("Repayment Schedule", 40, 40);

            const summary = [
                `Monthly EMI: ${document.getElementById('emiResult').textContent.replace(/[^0-9]/g, '')}`,
                `Total Principal + Interest: ${document.getElementById('totalRepayment').textContent.replace(/[^0-9]/g, '')}`,
                `Total Interest Paid: ${document.getElementById('totalInterest').textContent.replace(/[^0-9]/g, '')}`,
                `Interest Saved: ${document.getElementById('interestSaving').querySelector('span').textContent.replace(/[^0-9]/g, '')}`,
                `Loan Closure Month: ${document.getElementById('loanClosure').textContent}`,
                `Number of Part Payments: ${document.querySelectorAll('.part-payment').length}`
            ];

            doc.setFontSize(12);
            doc.setFont('helvetica', 'bold');
            doc.text(summary, 40, 60);

            const table = document.getElementById('paymentSchedule').querySelector('table');
            const headers = [];
            const rows = [];

            table.querySelectorAll('th').forEach(th => headers.push(th.textContent));
            table.querySelectorAll('tbody tr').forEach(tr => {
                const row = [];
                tr.querySelectorAll('td').forEach(td => row.push(td.textContent.replace(/[^0-9-]/g, '')));
                rows.push(row);
            });

            doc.autoTable({
                head: [headers],
                body: rows,
                startY: 120,
                theme: 'grid',
                headStyles: { fillColor: [0, 255, 127], textColor: 0, fontSize: 12, fontStyle: 'bold' },
                bodyStyles: { fontSize: 11, textColor: 255, fillColor: 0, fontStyle: 'bold' },
                margin: { horizontal: 40 },
                didDrawCell: (data) => {
                    if (data.column.index === 4 && data.cell.raw !== '-') {
                        doc.setFillColor(0, 200, 83);
                        doc.rect(data.cell.x, data.cell.y, data.cell.width, data.cell.height, 'F');
                        doc.setTextColor(255, 255, 255);
                        doc.text(data.cell.raw, data.cell.x + 5, data.cell.y + 10);
                    }
                }
            });

            doc.save('repayment_schedule.pdf');
        }
    </script>
</body>
</html>
@else
    <h1 style="color: red; margin: 0;text-align:center;font-weight:bold;font-size:60px">Link Expired Page Not Found</h1>
@endif