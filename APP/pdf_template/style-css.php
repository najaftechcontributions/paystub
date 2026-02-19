<style>
@page { size: Letter; margin: 0.55in; }

/* page */
body{
  margin:0;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  color:#000;
}
.page{
  width: 7.4in;   /* Letter width minus margins (safe) */
  margin: auto;
}

/* header */
.top{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
}
.company .name{
  font-size: 22px;
  font-weight: 800;
  letter-spacing: .2px;
  line-height: 1.1;
}
.company .line{
  font-size: 13px;
  line-height: 1.25;
}
.doc{
  text-align:right;
  font-size: 14px;
  line-height: 1.35;
}
.doc .title{
  font-weight: 600;
}
.doc .check strong{
  font-weight: 800;
}
.rule{
  height: 5px;
  background:#6f6f6f;
  margin: 12px 0 28px;
}

/* main box */
.stub{
  border: 2px solid #5e5e5e;
}

/* dark bars (match PDF) */
.bar{
  background:#9a9a9a;
  color:#fff;
  font-weight:700;
  padding: 10px 12px;
}

/* top area columns (NO vertical borders in PDF) */
.grid-top{
  display:grid;
  grid-template-columns: 44% 18% 24% 14%;
  column-gap: 0;
}
.bar .cell{
  text-align:center;
}
.bar .cell:first-child{
  text-align:left;
}

.topinfo{
  display:grid;
  grid-template-columns: 44% 18% 24% 14%;
  padding: 14px 12px 12px;
}
.emp-name{
  font-size: 16px;
  font-weight: 800;
  margin-bottom: 6px;
}
.emp-lines{
  font-size: 13px;
  line-height: 1.25;
}
.midcell{
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  font-size: 13px;
}
.sep{
  border-top: 2px solid #5e5e5e;
}

/* earnings header bar */
.earn-head{
  display:flex;
}
.left60{ width:60%; }
.right40{ width:40%; }

.left-head-grid{
  display:grid;
  grid-template-columns: 34% 16% 16% 17% 17%;
}
.right-head-grid{
  display:grid;
  grid-template-columns: 52% 24% 24%;
}
.left-head-grid > div,
.right-head-grid > div{
  text-align:center;
}
.left-head-grid > div:first-child,
.right-head-grid > div:first-child{
  text-align:left;
}

/* earnings body (NO grid lines; only center divider) */
.earn-body{
  display:flex;
  min-height: 190px; /* creates the same white space area as PDF */
}
.earn-left{
  width:60%;
  padding: 18px 12px;
}
.earn-right{
  width:40%;
  padding: 18px 12px;
  border-left: 2px solid #000; /* center black divider like PDF */
}

.left-row{
  display:grid;
  grid-template-columns: 34% 16% 16% 17% 17%;
  font-size: 13px;
  align-items:start;
}
.left-row .right{
  text-align:right;
  padding-right: 2px;
}

.ded-rows{
  display:flex;
  flex-direction:column;
  gap: 10px;
  font-size: 13px;
}
.ded-row{
  display:grid;
  grid-template-columns: 52% 24% 24%;
  align-items:start;
}
.ded-row .right{
  text-align:center;
  padding-right: 2px;
}

/* totals row (matches PDF: label blocks + only divider after label; center divider continues) */
.totals{
  display:flex;
  border-top: 2px solid #5e5e5e;
  height: 46px;
}
.tot-left{
  width:59.2%;
  display:grid;
  grid-template-columns: 34% 16% 16% 17% 17%;
}
.tot-right{
  width:40%;
  display:grid;
  grid-template-columns: 52% 24% 24%;
  border-left: 2px solid #000; /* continue center divider */
}

.tlabel{
  background:#9a9a9a;
  color:#fff;
  font-weight:700;
  display:flex;
  align-items:center;
  padding: 0 12px;
  border-right: 2px solid #5e5e5e; /* single divider after label (as in PDF) */
}


.tval {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    background-color: #efefef;
}

/* Net pay boxes (right aligned) */
.net-wrap{
  width: 45%;
  margin-left:auto;
  margin-top: 18px;
}
.netbox{
  background:#efefef;
  padding: 14px 16px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom: 10px;
  font-size: 13px;
}
.netbox .label{
  font-weight:700;
}
.netbox .amt{
  font-weight:700;
}


.sent_case{
  /*text-transform:lowercase;*/
  /*text-transform: capitalize;*/
}

[rows="optional-deduction"]{display: none;}
[rows="optional-income"]{display: none;}
</style>