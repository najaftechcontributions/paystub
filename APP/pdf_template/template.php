<?php include "style-css.php"; ?>

<div class="page">

  <!-- TOP HEADER -->
  <div class="top">
    <div class="company">
      <div class="name"><span pid="p5">DESIGN LLC</span></div>
      <!-- Not in calculator PIDs, but exists in PDF -->
      <!-- <div class="line"><span pid="t_company_id">(00-0012345)</span></div> -->
      <div class="line"><span pid="p6">41, Any Street, Any Town, CA</span></div>
    </div>

    <div class="doc">
      <div class="title">Earnings Statement</div>
      <div class="check">Check Number: <strong><span pid="p4">2810</span></strong></div>
    </div>
  </div>

  <div class="rule"></div>

  <!-- MAIN STUB BOX -->
  <div class="stub">

    <!-- Employee info header bar -->
    <div class="bar grid-top">
      <div class="cell">Employee Information</div>
      <div class="cell">Pay Date</div>
      <div class="cell">Pay Period</div>
      <div class="cell">Pay Schedule:</div>
    </div>

    <!-- Employee info content (NO vertical borders) -->
    <div class="topinfo">
      <div>
        <div class="emp-name"><span pid="p7">George Mathew</span></div>
        <div class="emp-lines">
          (XXX-XX-<span pid="p8">0909</span>)<br>
          <span pid="p11">1839, Echo Lane, San Leandro</span><br>
          <!-- <span pid="t_emp_city">CA 94578</span> -->
        </div>
      </div>

      <div class="midcell"><span pid="p12">Jan 06, 2023</span></div>

      <div class="midcell">
        <span pid="p14">Jan 01, 2023 - <br> Jan 07, 2023</span> 
        <!-- <br> <span pid="p14">Jan 07, 2023</span> -->
      </div>

      <div class="midcell"><span pid="p15">Weekly</span></div>
    </div>

    <div class="sep"></div>

    <!-- Earnings / Deductions header bar -->
    <div class="bar earn-head">
      <div class="left60">
        <div class="left-head-grid">
          <div>Earnings</div>
          <div>Rate</div>
          <div>Hours</div>
          <div>Current</div>
          <div>YTD</div>
        </div>
      </div>
      <div class="right40">
        <div class="right-head-grid">
          <div>Taxes / Deductions</div>
          <div>Current</div>
          <div>YTD</div>
        </div>
      </div>
    </div>

    <!-- Body (ONLY center divider, no other borders) -->
    <div class="earn-body">
      <div class="earn-left">
        <!-- Only one visible row like PDF example -->
        <div class="left-row">
          <div><span pid="t_earn_label_1">REGULAR</span></div>
          <div class="right"><span pid="p17">15.00</span></div>
          <div class="right"><span pid="p18">40</span></div>
          <div class="right"><span pid="p19">600.00</span></div>
          <div class="right"><span pid="p20">600.00</span></div>
        </div>


        <div class="left-row" rows="optional-income">
          <div><span pid="t_earn_label_1" class="sent_case">OVERTIME</span></div>
          <div class="right"><span pid="p21">15</span></div>
          <div class="right"><span pid="p22">40</span></div>
          <div class="right"><span pid="p23">600</span></div>
          <div class="right"><span pid="p24">600</span></div>
        </div>


        <div class="left-row" rows="optional-income">
          <div><span pid="t_earn_label_1" class="sent_case">HOLIDAY</span></div>
          <div class="right"><span pid="p25">15</span></div>
          <div class="right"><span pid="p26">40</span></div>
          <div class="right"><span pid="p27">600</span></div>
          <div class="right"><span pid="p28">600</span></div>
        </div>


        <div class="left-row" rows="optional-income">
          <div><span pid="t_earn_label_1" class="sent_case">VACATION</span></div>
          <div class="right"><span pid="p29">15</span></div>
          <div class="right"><span pid="p30">40</span></div>
          <div class="right"><span pid="p31">600</span></div>
          <div class="right"><span pid="p32">600</span></div>
        </div>


        <div class="left-row" rows="optional-income">
          <div><span pid="t_earn_label_1" class="sent_case">BONUS</span></div>
          <div class="right"><span pid="p33">15</span></div>
          <div class="right"><span pid="p34">40</span></div>
          <div class="right"><span pid="p35">600</span></div>
          <div class="right"><span pid="p36">600</span></div>
        </div>


        <div class="left-row" rows="optional-income">
          <div><span pid="t_earn_label_1" class="sent_case">FLOAT</span></div>
          <div class="right"><span pid="p37">15</span></div>
          <div class="right"><span pid="p38">40</span></div>
          <div class="right"><span pid="p39">600</span></div>
          <div class="right"><span pid="p40">600</span></div>
        </div>

     

      </div>

      <div class="earn-right">
        <!-- 5 lines like your PDF sample -->
        <div class="ded-rows">
  
          <div class="ded-row">
            <div><span pid="t_ded_label_2">FICA-MEDICARE</span></div>
            <div class="right"><span pid="p41">40</span></div>
            <div class="right"><span pid="p42">600.00</span></div>
          </div>

          <div class="ded-row">
            <div><span pid="t_ded_label_3">FICA-SOCIAL SEC.</span></div>
            <div class="right"><span pid="p43">40</span></div>
            <div class="right"><span pid="p44">600.00</span></div>
          </div>

          <div class="ded-row">
            <div><span pid="t_ded_label_1">FEDERAL TAX</span></div>
            <div class="right"><span pid="p45">40</span></div>
            <div class="right"><span pid="p46">600.00</span></div>
          </div>

          <div class="ded-row">
            <div><span pid="t_ded_label_4">STATE TAX</span></div>
            <div class="right"><span pid="p47">40</span></div>
            <div class="right"><span pid="p48">600.00</span></div>
          </div>



        <div class="ded-row" rows="optional-deduction" rowc="0">
            <div><span pid="label_od_0">NJ SDI</span></div>
            <div class="right"><span pid="p49">40</span></div>
            <div class="right"><span pid="p50">600.00</span></div>
          </div>



        <div class="ded-row" rows="optional-deduction" rowc="1">
            <div><span pid="label_od_1">NJ SUI</span></div>
            <div class="right"><span pid="p51">40</span></div>
            <div class="right"><span pid="p52">600.00</span></div>
          </div>



        <div class="ded-row" rows="optional-deduction" rowc="2">
            <div><span pid="label_od_2">NJ FLI</span></div>
            <div class="right"><span pid="p53">40</span></div>
            <div class="right"><span pid="p54">600.00</span></div>
          </div>



        <div class="ded-row" rows="optional-deduction" rowc="3">
            <div><span pid="label_od_3">NJ WFD</span></div>
            <div class="right"><span pid="p55">40</span></div>
            <div class="right"><span pid="p56">600.00</span></div>
          </div>


    

          
        </div>
      </div>
    </div>

    <div class="sep"></div>

    <!-- Totals row -->
    <div class="totals">
      <div class="tot-left">
        <div class="tlabel" style="grid-column: 1 / span 3;">Total Earnings</div>
        <div class="tval" style="grid-column: 4;"><span pid="p57">0.00</span></div>
        <div class="tval" style="grid-column: 5;"><span pid="p58">0.00</span></div>
      </div>

      <div class="tot-right">
        <div class="tlabel" style="grid-column: 1;">Total Deduction</div>
        <div class="tval" style="grid-column: 2;"><span pid="p59">0.00</span></div>
        <div class="tval" style="grid-column: 3;"><span pid="p60">0.00</span></div>
      </div>
    </div>

  </div>

  <!-- Net pay blocks -->
  <div class="net-wrap">
    <div class="netbox">
      <div class="label">Net Pay</div>
      <div class="amt"><span pid="p61">600.00</span></div>
    </div>

    <div class="netbox">
      <div class="label">YTD Net Pay</div>
      <div class="amt"><span pid="p62">600.00</span></div>
    </div>
  </div>

</div>