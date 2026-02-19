<div class="card grid card-padding">

    <div class="input-div">
        <div>Your Email Address:</div>
        <div>
            <input type="email" class="khyzer" name="email" pid="user_email" placeholder="Enter" value="" required>
        </div>
    </div>

    <div class="input-div" style="display:none;">
        <div>How are you paid?</div>
        <div>
            <select class="khyzer" name="pay_type" required>
                <?php echo create_opt("Hourly, Salary", ""); ?>
            </select>

        </div>
    </div>


    <div class="input-div">
        <div> Select State</div>
        <div>
            <select class="khyzer" name="state" required>
                <?php echo get_states(); ?>
            </select>

        </div>
    </div>
    <div class="input-div cst-order">
        <div>
            <input style="transform: scale(1.4); " type="checkbox" class="khyzer" name="email" pid="user_email"
                value="1">
            <span style="color:#cb1219;">
                ADD <?php echo ($_POST['emp_status'] ?? 'Employee') === 'Contractor' ? 'CONTRACTOR' : 'EMPLOYEE'; ?>
                ADDRESS
            </span>
        </div>
    </div>
    <div class="input-div">
        <div> Employment Type</div>
        <div>
            <select class="khyzer" name="emp_status" id="emp_status">
                <option value="Employee" <?php echo ($_POST['emp_status'] ?? 'Employee') === 'Employee' ? 'selected' : ''; ?>>Employee</option>
                <option value="Contractor" <?php echo ($_POST['emp_status'] ?? 'Employee') === 'Contractor' ? 'selected' : ''; ?>>Contractor</option>
            </select>
        </div>
    </div>
    <div class="input-div">
        <div> Week In Hole</div>
        <div>
            <select class=" khyzer" name="week-in-hole">
                <option value="Off" selected>Off</option>
                <option value="On">On</option>
            </select>

        </div>
    </div>
    <div class="input-div">
        <div>Auto Calculation</div>
        <div>
            <select class=" khyzer" name="auto-calc">
                <option value="on" selected>On</option>
                <option value="off">Off</option>
            </select>

        </div>
    </div>
    <div class="input-div">
        <div>
            New Employee YTD <i class="fas fa-info-circle"
                title="Applicable ONLY to those who have started after January 1. Select week # employee started."></i>
        </div>
        <div>
            <select class="khyzer" name="emp_ytd" required>
                <option value="0">N/A</option>
                <?php echo create_range("1-52", 0); ?>
            </select>

        </div>
    </div>


    <div class="input-div noselect hide" sdi-field="1">
        <div>
            <span class="checkbox checked_" cname="include_sdi"></span>
            <span sdi-label="1">Include SDI <i class="fas fa-info-circle"
                    title="Check this box LAST after you are satisfied with your stub in order to include SDI taxes. Applicable ONLY to Rhode Island, Hawaii, California, New Jersey, and New York."></i></span>
        </div>
        <div style="display: none;">
            <select class="khyzer" name="include_sdi" required>
                <?php echo create_range("0-1", 0); ?>
            </select>

        </div>
    </div>


    <div class="input-div">
        <div>
            Number Of Pay Stubs Needed</div>
        <div>
            <select class="khyzer" name="no_of_paystub" pid="no_of_paystub" required>
                <option value="1">1</option>
                <?php echo create_range("2-12", ''); ?>
            </select>

        </div>
    </div>
    <div class="input-div flex  flex-row flex-gap-5">
        <div class="margin-0">
            <input style="transform: scale(1.4); " type="checkbox" class="khyzer" name="deposit-slip" pid="deposit_slip"
                value="1">
        </div>
        <div class="flex flex-col p-margin flex-gap-5">
            <p class="p-weight">Deposit Slip</p>
            <p style="color:#cb1219;font-style: italic;
    font-weight: 700;">(1.99$)</p>

        </div>
    </div>

    <input type="hidden" name="enable_additional_rows" pid="enable_additional_rows" value="0">

</div>

<style type="text/css">
    .pd-x {
        padding: 20px;
        /*min-height: 300px;*/
    }

    .input-div {
        margin-bottom: 18px;
    }

    .input-div>div:nth-child(1) {
        font-weight: 700;
        margin: 10px 0;
    }


    .checkbox {
        cursor: pointer;
    }

    .checkbox:before {
        content: "\f0c8 \00a0";
        font-family: "Font Awesome 5 Pro";
        font-weight: 400;
        color: var(--theme);
        cursor: pointer;
    }

    .checkbox.checked:before {
        content: "\f14a \00a0";
        font-family: "Font Awesome 5 Pro";
        font-weight: 900;
    }

    [sdi-label="1"] {
        cursor: pointer;
    }

    .flex {
        display: flex;
    }

    .flex-row {
        flex-direction: row;
    }

    .flex-col {
        flex-direction: column;
    }

    .flex-gap-5 {
        gap: 5px;
    }

    .p-margin p {
        margin: 0px !important;
    }

    .p-weight {
        font-weight: 700;
    }

    .margin-0 {
        margin: 0px !important;
    }
</style>