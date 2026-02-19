<div class="es-actions hide" action-btn="edit" no-print="1">
  <button class="es-btn" type="button" action="edit-stub">EDIT STUB <i class="fas fa-edit"></i></button>
</div>
<div class="es-card card">
  <!-- Top ribbon -->
  <div class="es-ribbon">
    <div class="flex flex-col">
      <div class="">
        <input class="es-check cmp-name" type="text" placeholder="Company Name" name="company_name" />
      </div>
      <div class="">
        <input class="es-check" type="text" placeholder="Company Address" name="company_address" />
      </div>
    </div>
    <div class="flex flex-col">
      <div class="es-title">EARNINGS STATEMENT</div>
      <input class="es-check" type="text" placeholder="# Check No." field="check_no" />
    </div>
  </div>

  <!-- Grid -->
  <div class="es-grid">

    <!-- Row: company -->

    <!-- Row: employee + ssn + marital + employee no -->
    <div class="es-row es-4 ">
      <div class="es-cell ">
        <div class="es-h grey-bg padding-l-8 white-text ">EMPLOYEE NAME</div>
        <div class="input-inner-padding">
          <input class="es-in m-t-8 " type="text" placeholder="Employee Name" name="employee_name" />
        </div>
      </div>

      <div class="es-cell">
        <div class="es-h grey-bg white-text">SSN</div>
        <div class="es-inline input-inner-padding">
          <input class="es-in es-in-ssn m-t-8" type="text" name="ssn" required minlength="11" maxlength="11"
            value="XXX-XX-" />

        </div>
      </div>

      <div class="es-cell">
        <div class="es-h grey-bg white-text">MARITAL STATUS</div>
        <div class="input-inner-padding">
          <select class="es-in m-t-8 " name="marital_status">
            <?php echo create_opt("Single, Married", ""); ?>
            <!-- <option>Single</option>
            <option>Married</option>
            <option>Head of Household</option> -->
          </select>
        </div>
      </div>

      <div class="es-cell">
        <div class="es-h grey-bg padding-r-8 white-text">EMPLOYEE NO.</div>
        <div class="input-inner-padding">
          <input class="es-in m-t-8  " type="text" placeholder="12" name="employee_no" />
        </div>
      </div>
    </div>

    <!-- Row: employee address -->
    <div class="es-row es-1 white-bg">
      <div class="es-cell ">
        <div class="input-inner-padding">
          <input class="m-t-8 es-in padding-l padding-r input-border-top-bottom" type="text"
            placeholder="Employee Address" name="employee_address" />
        </div>
      </div>
    </div>

    <!-- Row: pay date + pay period + pay mode + exemptions -->
    <div class="es-row es-4 es-payrow">
      <div class="es-cell border-none white-bg">
        <div class="es-h grey-bg white-text padding-l-8">PAY DATE</div>
        <div class="padding-l input-inner-padding">
          <input class="es-in m-t-8" type="text" value="01/14/2026" date-field="pay_date" name="pay_date" />
        </div>
      </div>

      <div class="es-cell es-span-2 border-none white-bg">
        <div class="es-h grey-bg white-text">PAY PERIOD</div>
        <div class="es-inline input-inner-padding">
          <input class="es-in m-t-8" type="text" value="01/07/2026" date-field="pay_period_start" />
          <span class="es-dash">-</span>
          <input class="es-in m-t-8" type="text" value="01/13/2026" date-field="pay_period_end" />
        </div>
      </div>

      <div class="es-cell border-none white-bg">
        <div class="es-h grey-bg white-text">PAY MODE</div>
        <div class="input-inner-padding">
          <select class="es-in m-t-8" name="pay_mode">
            <?php echo create_opt("Weekly, Bi-Weekly, Monthly, Bi-Monthly, Annually", ""); ?>
            <!-- <option>Weekly</option> -->
          </select>
        </div>
      </div>

      <div class="es-cell border-none white-bg">
        <div class="es-h grey-bg white-text">EXEMPTIONS</div>
        <div class="padding-r input-inner-padding">
          <select class="es-in m-t-8" name="exemptions">
            <?php echo create_range("0-9", 0); ?>
            <!-- <option>0</option> -->
          </select>
        </div>
      </div>
    </div>


    <!-- Big middle section: earnings (left) + deductions (right) -->
    <div class="es-row es-2 es-middle">
      <!-- Earnings table -->
      <div class="es-cell white-bg">
        <div class="es-subhead grey-bg  white-text">
          <div class="subhead-earnings-label">EARNINGS</div>
          <div>RATE</div>
          <div>HOURS</div>
          <div>CURRENT</div>
          <!-- <div>YTD</div> -->
        </div>

        <div class="es-table" table="pay_table">
          <!-- REGULAR -->
          <div class="es-tr border-btm">
            <div class="es-td es-lbl ">REGULAR</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="15.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="40" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="600.00" />
            </div>
            <div class="es-td hide-imp"><input class="es-in es-in-sm transparent-input-clr-blck"
                type="text" value="1200.00" />
            </div>
          </div>

          <!-- OVERTIME -->
          <div class="es-tr border-btm" addon-rows="income">
            <div class="es-td es-lbl">OVERTIME</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="22.50" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
          </div>

          <!-- HOLIDAY -->
          <div class="es-tr border-btm" addon-rows="income">
            <div class="es-td es-lbl">HOLIDAY</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
          </div>

          <!-- VACATION -->
          <div class="es-tr border-btm" addon-rows="income">
            <div class="es-td es-lbl">VACATION</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
          </div>

          <!-- BONUS -->
          <div class="es-tr border-btm" addon-rows="income">
            <div class="es-td es-lbl">BONUS</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value="0.00" />
            </div>
          </div>

          <!-- FLOAT -->
          <div class="es-tr border-btm" addon-rows="income">
            <div class="es-td es-lbl">FLOAT</div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="0.00" /></div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="0" /></div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="0.00" /></div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="0.00" /></div>
          </div>
        </div>
      </div>

      <!-- Deductions table -->
      <div class="es-cell" table="deduction">
        <div class="es-subhead es-subhead-d grey-bg  white-text">
          <div>DEDUCTIONS</div>
          <div>TOTAL</div>
          <div>YTD TOTAL</div>
        </div>

        <div class="es-table es-table-d white-bg deductions-table-inner">
          <div class="es-tr border-btm">
            <div class="es-td es-lbl">FICA-MEDICARE</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="fica_medicare_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="fica_medicare_ytd_total" /></div>
          </div>

          <div class="es-tr border-btm">
            <div class="es-td es-lbl">FICA-SOCIAL SEC.</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="fica_ss_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="fica_ss_ytd_total" /></div>
          </div>

          <div class="es-tr border-btm">
            <div class="es-td es-lbl">FEDERAL TAX</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="federal_tax_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="federal_tax_ytd_total" /></div>
          </div>

          <div class="es-tr border-btm">
            <div class="es-td es-lbl">STATE TAX</div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="state_tax_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm transparent-input-clr-blck" type="text" value=""
                result="state_tax_ytd_total" /></div>
          </div>


          <div class="es-tr border-btm hide-imp" custom-row="SDI">
            <div class="es-td es-lbl" custom-label="sdi" pdi_label="label_od_0">NJ SDI</div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="sdi_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="sdi_ytd_total" /></div>
          </div>

          <div class="es-tr border-btm hide-imp" custom-row="NJ">
            <div class="es-td es-lbl">NJ SUI</div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="sui_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="sui_ytd_total" /></div>
          </div>


          <div class="es-tr border-btm hide-imp" custom-row="NJ">
            <div class="es-td es-lbl">NJ FLI</div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="fli_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="fli_ytd_total" /></div>
          </div>


          <div class="es-tr border-btm hide-imp" custom-row="NJ">
            <div class="es-td es-lbl">NJ WFD</div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="wrk_total" /></div>
            <div class="es-td"><input class="es-in es-in-sm" type="text" value="" result="wrk_ytd_total" /></div>
          </div>


        </div>
      </div>
    </div>

    <!-- Bottom totals -->
    <!-- <div class="es-row es-3 es-bottom">

      <div class="es-cell es-gross" label="responsive">
        <div class="es-h2"></div>
        <div class="es-inline es-right">
          <h2 class="es-in es-in-md h2-label">Total</h2>
          <h2 class="es-in es-in-md h2-label">YTD Total</h2>
        </div>
      </div>


      <div class="es-cell es-gross grey-bg">
        <div class="es-h2 white-text">GROSS PAY</div>
        <div class="es-inline es-right">
          <input class="es-in es-in-md transparent-input zero-pad-marg" type="text" value="" name="gross_pay_total"
            result="gross_pay_total" />
          <input class="es-in es-in-md transparent-input zero-pad-marg" type="text" value="" result="gross_pay_ytd" />
        </div>
      </div>

      <div class="es-cell es-totalded grey-bg">
        <div class="es-h2 white-text">TOTAL DEDUCTIONS</div>
        <div class="es-inline es-right">
          <input class="es-in es-in-md transparent-input zero-pad-marg txt-lft" type="text" value=""
            result="deductions" />
          <input class="es-in es-in-md transparent-input zero-pad-marg txt-lft" type="text" value=""
            result="ytd_deductions" />
        </div>
      </div>

      <div class="es-cell es-net">
        <div class="es-h2">NET PAY</div>
        <div class="es-inline es-right">
          <input class="es-in es-in-md transparent-input-clr-blck " type="text" value="" result="net_pay" />
          <input class="es-in es-in-md transparent-input-clr-blck " type="text" value="" result="ytd_net_pay" />
        </div>
      </div>
    </div> -->

    <div class="es-row es-6 ">
      <div class="es-cell ">
        <div class="es-h grey-bg padding-l-8 white-text ">YTD GROSS</div>
        <div class="input-inner-padding">
          <input class="es-in m-t-8 txt-lft" type="text" value="" result="gross_pay_ytd" />
        </div>
      </div>

      <div class="es-cell">
        <div class="es-h grey-bg white-text">YTD DEDUCTIONS</div>
        <div class="es-inline input-inner-padding">
          <input class="es-in  m-t-8 txt-lft" type="text" value="" result="ytd_deductions" />
        </div>
      </div>

      <div class="es-cell">
        <div class="es-h grey-bg white-text">YTD NET PAY</div>
        <div class="input-inner-padding">
          <input class="es-in m-t-8 txt-lft" type="text" value="" result="ytd_net_pay" />
        </div>
      </div>

      <div class="es-cell">
        <div class="es-h grey-bg padding-r-8 white-text">CURRENT TOTAL</div>
        <div class="input-inner-padding">
          <input class="es-in m-t-8 txt-lft" type="text" value="" name="gross_pay_total" result="gross_pay_total" />
        </div>
      </div>
      <div class="es-cell">
        <div class="es-h grey-bg padding-r-8 white-text">CURRENT DEDUCTIONS</div>
        <div class="input-inner-padding">
          <input class="es-in m-t-8 txt-lft" type="text" value="" result="deductions" />
        </div>
      </div>
      <div class="es-cell">
        <div class="es-h grey-bg padding-r-8 white-text">NET PAY</div>
        <div class="input-inner-padding">
          <input class="es-in m-t-8 txt-lft " type="text" value="" result="net_pay" />

        </div>
      </div>
    </div>

  </div>


  <!-- Button -->

</div>

<?php include __DIR__ . '/deposit-slip-template.php'; ?>
