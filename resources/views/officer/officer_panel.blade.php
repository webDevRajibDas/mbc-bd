@extends('layouts.app')

@section('title', 'Officer Panel')
@section('header-title', 'Officer Panel')
@section('sidebar')
  @include('officer.partial.sidebar')
@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Baloo+Da+2:wght@500;600;700;800&display=swap" rel="stylesheet">
<style>
  .officer-panel{
    --bg: #00b9a2;
    --panel-blue: #cfe4f7;
    --panel-blue-deep: #9fc7ea;
    --header-blue: #eaf3fb;
    --navy: #14335c;
    --red: #d21f1f;
    --green: #1a7d2e;
    --purple: #6a3fa0;
    --orange: #e08a1f;
    --gold: #d9a441;
    --white: #ffffff;
    --card-radius: 14px;
  }
  .officer-panel,
  .officer-panel *{
    box-sizing:border-box;
  }
  .officer-panel{
    min-height: calc(100vh - 69px);
    margin: -12px;
    font-family:'Hind Siliguri', 'Baloo Da 2', sans-serif;
    background: var(--bg);
    color:#222;
    padding: 24px;
  }
  .officer-app{
    display:grid;
    grid-template-columns: minmax(360px, 525px) minmax(0, 1fr);
    gap: 20px;
    max-width: 1760px;
    margin: 0 auto;
    align-items:start;
  }
  @media (max-width: 950px){
    .officer-app{ grid-template-columns: 1fr; }
  }

  /* ---------- LEFT COLUMN ---------- */
  .left-col,
  .right-col{
    min-width:0;
  }
  .left-col{ display:flex; flex-direction:column; gap:16px; }

  .header-card{
    background: #000;
    border-radius: var(--card-radius);
    padding: 14px;
    display:grid;
    grid-template-columns: 120px minmax(0, 1fr);
    gap: 12px;
    align-items:start;
    position:relative;
    overflow:hidden;
  }
  .back-arrow{
    position:absolute; top:14px; left:14px;
    width:30px;height:26px;
    background:#3a6bd6; color:#fff;
    display:flex;align-items:center;justify-content:center;
    border-radius:4px; font-weight:700;
  }
  .brand-block{
    grid-column: 1 / 2;
    display:flex; flex-direction:column; align-items:center;
    padding-top: 34px;
  }
  .avatar{
    width:96px;height:96px;border-radius:50%;
    background: radial-gradient(circle at 35% 30%, #8892a8, #23262e);
    border:3px solid #333;
    display:flex;align-items:center;justify-content:center;
    color:#cfd6e6; font-size:11px; text-align:center;
    overflow:hidden;
  }
  .avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .officer-name{
    margin-top:8px; font-size:13px; font-weight:600;
    background:#fff; border:1px solid #99a; border-radius:4px;
    padding:2px 10px; color:#555;
    text-align: center;
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .officer-role{
    margin-top:4px; font-size:12px; color:#c22;
    border:1px solid #c99; border-radius:4px; padding:2px 10px;
  }
  .brand-title{
    grid-column: 2 / 3;
    padding-top:2px;
    min-width:0;
  }
  .brand-logo-row{ display:flex; align-items:center; gap:8px; }
  .logo-circle{
    width:38px;height:38px;border-radius:50%;
    background:#fff; border:3px solid #1a7d2e;
    display:flex;align-items:center;justify-content:center;
    font-weight:800; color:#1a7d2e; font-size:14px;
  }
  .brand-name{ font-size:clamp(18px, 2.1vw, 26px); font-weight:800; color:var(--red); line-height:1.1; }
  .brand-sub{ font-size:13px; font-weight:700; color:#8fb9ff; margin-top:2px; }
  .brand-tag{ font-size:14px; font-weight:700; color:#e5e7eb; margin-top:4px; }

  .notish{
    grid-column: 1 / -1;
    display:flex;
    flex-direction:column;
    gap:8px;
    text-align:left;
  }
  .notish-title{
    font-size:20px;
    font-weight:800;
    color:#fff;
    margin:0;
  }
  .point-actions{display:grid;grid-template-columns:1fr;gap:7px;}
  .pill-row{
    display:flex; align-items:center; justify-content:space-between; gap:8px; margin:0;
    min-width:0;
    cursor: pointer;
  }
  .pill{
    background:#fff; border:1px solid #9ab; border-radius:16px;
    padding:5px 14px; font-size:13px; font-weight:600; color:#333;
    min-width:0; width:100%; text-align:center;
    transition: background 0.2s;
  }
  .pill-row:hover .pill {
    background: #f1f5f9;
  }
  .dot{ width:20px;height:20px;border-radius:50%; flex:none; }
  .dot.pink{ background:#e79bb0; }
  .dot.yellow{ background:#f2d43c; }
  .dot.blue{ background:#4aa8e0; }
  .dot.orange{ background:#e88a2e; }
  .letter-row{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:4px;margin-top:3px;}
  .letter-button{display:flex;align-items:center;justify-content:center;gap:5px;min-height:33px;border:1px solid rgba(255,255,255,.45);border-radius:4px;background:#edf3f8;color:#17375d;font:800 16px/1 'Hind Siliguri',sans-serif;cursor:pointer;}
  .letter-button span{font-size:13px;line-height:1;}
  .letter-button:hover,.letter-button.active{background:#09a963;color:#fff;}
  .letter-button:nth-child(2):hover{background:#149bce}.letter-button:nth-child(3):hover{background:#1875b5}.letter-button:nth-child(4):hover{background:#d49292}.letter-button:nth-child(5):hover{background:#ecbf7b}
  .officer-label{font-size:14px; font-weight:700; color:#e5e7eb; margin-top:2px; }

  .nav-card{
    background: linear-gradient(180deg, #2f8fd6, #1f6fb8);
    border-radius: var(--card-radius);
    padding: 18px;
    color:#fff;
    position:relative;
  }
  .nav-top{
    display:flex; align-items:center; gap:14px; margin-bottom:16px; flex-wrap:wrap;
  }
  .nav-top .about{ font-size:18px; font-weight:700; }
  .icon-btn{
    width:34px;height:34px;border-radius:6px;
    display:flex;align-items:center;justify-content:center;
    font-size:15px; font-weight:700; color:#fff; flex:none;
    text-decoration: none;
  }
  .icon-btn.gear{ background:#eee; color:#333; }
  .icon-btn.profile-txt{ background:transparent; color:#fff; font-size:14px; width:auto; font-weight:600;}
  .icon-btn.play{ background:#e23a3a; }
  .icon-btn.fb{ background:#3b5998; }
  .icon-btn.team{ background:#d9a441; border-radius:50%; }
  .icon-btn.chat{ background:#eee; color:#333; width:auto; padding:0 10px; border-radius:16px; font-size:12px;}

  .menu-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    align-items:center;
  }
  .menu-btn{
    background:#fff; color:#14335c;
    border-radius: 22px;
    padding: 12px 8px;
    text-align:center;
    font-weight:700;
    font-size: 15px;
    box-shadow: 0 2px 0 rgba(0,0,0,0.15);
    border:0;
    display:block;
    text-decoration:none;
    cursor: pointer;
    transition: all 0.2s;
  }
  .menu-btn:hover{ color:#14335c; text-decoration:none; filter:brightness(.97); }
  .menu-btn.active{
    background: #0c6b5e;
    color: #fff;
    box-shadow: 0 2px 0 rgba(0,0,0,0.1);
  }
  .menu-btn.active:hover { color: #fff; }

  .bottom-row{
    display:flex; justify-content:space-between; align-items:center;
    margin-top:16px; font-size:13px; font-weight:600; color:#eaf3ff;
  }
  .logout-txt{ font-weight:700; }

  .sub-panels{
    display:flex; flex-direction:column; gap:14px;
  }
  .sub-nav-list {
    margin: 0;
    padding: 0;
    list-style: none;
  }
  .sub-nav-list li {
    font-size: 14px;
    margin-bottom: 8px;
    padding-left: 14px;
    position: relative;
    color: #1a3f8f;
    font-weight: 600;
  }
  .sub-nav-list li::before {
    content: "O";
    position: absolute;
    left: 0;
    top: 0;
    color: #333;
    font-weight: 800;
    font-size: 11px;
  }
  .sub-nav-list li.has-badges {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 6px;
  }
  .sub-link {
    color: #1a3f8f;
    text-decoration: none;
    transition: color 0.15s;
  }
  .sub-link:hover,
  .sub-link.active {
    color: var(--red);
    text-decoration: underline;
  }
  .level-badges{ display:flex; gap:6px; align-items: center; }
  .level-chip{
    font-size:11px; background:#fff; border:1px solid #99a; border-radius:4px;
    padding:2px 8px; color:#333; display:inline-block;
    cursor: pointer;
    text-decoration: none !important;
  }
  .level-chip.active {
    background: var(--red);
    color: #fff;
    border-color: var(--red);
  }
  .sub-card{
    background: var(--header-blue);
    border-radius: var(--card-radius);
    padding: 16px;
  }
  .sub-card h3{
    margin:0 0 10px 0; font-size:17px; font-weight:800; color:#111;
  }

  /* ---------- RIGHT COLUMN & WORKSPACES ---------- */
  .right-col{ display:flex; flex-direction:column; gap:16px; }
  .workspace-section {
    display: none;
    flex-direction: column;
    gap: 16px;
  }
  .workspace-section.active {
    display: flex;
  }
  .ws-card {
    background: #fff;
    border-radius: var(--card-radius);
    padding: 20px;
    border: 1px solid #dce8f3;
  }
  .ws-card h3 {
    margin: 0 0 16px;
    color: var(--navy);
    font-size: 18px;
    font-weight: 800;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 8px;
  }

  /* Form Styling */
  .form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
  }
  @media (max-width: 600px) {
    .form-grid { grid-template-columns: 1fr; }
  }
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-bottom: 12px;
  }
  .form-group.full-width {
    grid-column: span 2;
  }
  @media (max-width: 600px) {
    .form-group.full-width { grid-column: span 1; }
  }
  .form-group label {
    font-size: 13px;
    font-weight: 700;
    color: #475569;
  }
  .form-group input,
  .form-group select,
  .form-group textarea {
    height: 40px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 0 12px;
    font-size: 13.5px;
    color: #334155;
    background: #fff;
  }
  .form-group input:focus,
  .form-group select:focus {
    border-color: #3a6bd6;
    outline: 0;
    box-shadow: 0 0 0 3px rgba(58, 107, 214, 0.15);
  }
  .form-group input[readonly] {
    background: #f8fafc;
    color: #64748b;
    cursor: not-allowed;
  }
  .form-submit-btn {
    background: var(--navy);
    color: #fff;
    border: 0;
    border-radius: 6px;
    padding: 10px 28px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    align-self: flex-start;
    transition: background 0.2s;
  }
  .form-submit-btn:hover {
    background: #0d284f;
  }

  /* Table styling */
  .ws-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  .ws-table th,
  .ws-table td {
    border: 1px solid #cbd5e1;
    padding: 10px 12px;
    text-align: left;
    font-size: 13.5px;
  }
  .ws-table th {
    background: #f1f5f9;
    color: var(--navy);
    font-weight: 700;
  }
  .ws-table tr.total-row {
    background: #f8fafc;
    font-weight: 700;
  }
  .ws-table tr.highlight-green {
    background: #d1e7dd;
    color: #0f5132;
    font-weight: 700;
  }
  .ws-table tr.highlight-orange {
    background: #fff3cd;
    color: #664d03;
    font-weight: 700;
  }
  .rank-summary{
    display:grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 12px;
  }
  .rank-summary-item{
    background:#f8fafc;
    border:1px solid #dbe6f1;
    border-radius:8px;
    padding:12px;
  }
  .rank-summary-label{
    color:#64748b;
    font-size:12px;
    font-weight:700;
  }
  .rank-summary-value{
    color:var(--navy);
    font-size:24px;
    font-weight:800;
    line-height:1.1;
    margin-top:4px;
  }
  .rank-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:32px;
    height:28px;
    border-radius:6px;
    background:#14335c;
    color:#fff;
    font-weight:800;
  }
  .rank-visual{
    margin-bottom:18px;
  }
  .rank-tree{
    display:grid;
    grid-template-columns: repeat(6, minmax(82px, 1fr));
    align-items:end;
    gap:0;
    min-width:620px;
  }
  .rank-tree-cell{
    text-align:center;
    position:relative;
  }
  .rank-top-balls{
    min-height:42px;
    display:flex;
    justify-content:center;
    align-items:end;
    gap:6px;
    margin-bottom:4px;
  }
  .mini-rank-ball{
    width:28px;
    height:28px;
    border:1px solid #333;
    background:#fff;
    color:#d21f1f;
    font-weight:800;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    position:relative;
  }
  .mini-rank-ball::before{
    content:"";
    position:absolute;
    inset:4px;
    border:1px solid #aaa;
    transform:rotate(45deg);
  }
  .mini-rank-ball span{
    position:relative;
    z-index:1;
  }
  .mini-rank-ball.green-text{
    color:#00a651;
  }
  .rank-number{
    background:#ffd20a;
    border:1px solid #111;
    height:54px;
    font-size:30px;
    display:flex;
    align-items:center;
    justify-content:center;
  }
  .rank-tree-cell:nth-child(n+4) .rank-number{
    background:#ecd5d5;
  }
  .rank-arrow{
    font-size:28px;
    line-height:1;
    color:#111;
  }
  .rank-dot-row{
    display:flex;
    justify-content:center;
    gap:6px;
  }
  .rank-dot{
    width:12px;
    height:12px;
    border-radius:50%;
    background:#082b67;
    box-shadow:0 0 0 6px #f4f4f4;
    margin:6px 2px;
  }
  .rank-dot.green{
    background:#06a951;
  }
  .rank-title-big{
    font-size:40px;
    font-weight:900;
    line-height:1;
    color:#000;
    margin:0 0 6px;
  }
  .rank-section-heading{
    font-size:34px;
    font-weight:900;
    line-height:1;
    color:#000;
    margin:6px 0 4px;
  }
  .rank-rule-table,
  .commission-table{
    width:100%;
    border-collapse:collapse;
    color:#111;
  }
  .rank-rule-table th,
  .rank-rule-table td,
  .commission-table th,
  .commission-table td{
    border:1px solid #111;
    padding:6px 10px;
    font-size:16px;
    line-height:1.1;
  }
  .rank-rule-table td:nth-child(2){
    text-align:center;
    white-space:nowrap;
    font-size:18px;
  }
  .rank-red{
    color:#ff0000;
    font-weight:800;
  }
  .commission-table th{
    color:#ff0000;
    font-size:18px;
    text-align:left;
  }
  .commission-table .name-col{
    min-width:120px;
  }
  .commission-note{
    font-size:14px;
    color:#111;
    margin:-4px 0 8px 74px;
  }
  @media (max-width: 700px) {
    .rank-summary{ grid-template-columns: 1fr; }
    .rank-title-big{ font-size:32px; }
    .rank-section-heading{ font-size:28px; }
  }

  .project-title{
    color:#fff; font-size:30px; font-weight:800; margin:0 0 4px 4px;
    display:flex; align-items:center; gap:10px;
  }
  .project-title .marker{ color:#fff; font-size:26px; }

  .hero-banner{
    border-radius: 10px;
    overflow:hidden;
    position:relative;
    height: 200px;
    background: repeating-linear-gradient(90deg, #3f7d3f 0 40px, #4a8c4a 40px 80px),
                linear-gradient(#bcd7ee, #bcd7ee);
    background-size: 100% 70%, 100% 100%;
    background-position: bottom, top;
    background-repeat: no-repeat;
  }
  .hero-banner::before{
    content:"";
    position:absolute; inset:0;
    background: linear-gradient(180deg, rgba(180,210,235,0.9) 0%, rgba(180,210,235,0.2) 45%, transparent 46%);
  }
  .hero-badge{
    position:absolute; top:16px; left:16px;
    background:#fff; border:3px solid var(--red); border-radius:6px;
    padding:8px 14px; text-align:center; z-index:2;
  }
  .hero-badge .bn{ color:var(--red); font-weight:700; font-size:13px; }
  .hero-badge .en{ color:#111; font-weight:800; font-size:13px; margin-top:2px; }

  .promo-row{
    display:flex; align-items:center; gap:10px; color:#fff; font-size:15px; font-weight:700;
  }
  .promo-row span.link-text{ color:#8fd0ff; text-decoration: underline wavy #8fd0ff; }
  .circle-btn{
    width:32px;height:32px;border-radius:6px;
    display:flex;align-items:center;justify-content:center; flex:none;
  }
  .circle-btn.red{ background:#e23a3a; color:#fff; font-size:14px; }
  .circle-btn.fb{ background:#3b5998; color:#fff; font-weight:800; font-size:15px; border-radius:6px; }

  .ad-rules-card{
    background:#f8fafc;
    border:1px solid #b6bec8;
    padding:16px;
    color:#111;
  }
  .ad-rule-main{
    border:1px solid #111;
    background:#fff;
    min-height:170px;
    padding:14px 16px 14px 42px;
    position:relative;
    font-size:14px;
    line-height:1.65;
  }
  .ad-rule-main p{
    margin:0;
  }
  .ad-rule-play,
  .ad-step-ball{
    width:30px;
    height:30px;
    border-radius:50%;
    border:2px solid #555;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:800;
    box-shadow:0 2px 4px rgba(0,0,0,0.25), inset 0 0 0 2px rgba(255,255,255,0.15);
    cursor:pointer;
    padding:0;
  }
  .ad-rule-play{
    position:absolute;
    left:12px;
    top:12px;
    background:#6b4f91;
    font-size:13px;
  }
  .ad-rule-red{
    color:#d21f1f;
    font-weight:800;
  }
  .ad-steps{
    margin-top:14px;
    display:flex;
    flex-direction:column;
    gap:10px;
  }
  .ad-step{
    display:grid;
    grid-template-columns:42px minmax(0, 1fr);
    align-items:center;
    gap:10px;
  }
  .ad-step-ball{
    width:40px;
    height:40px;
    font-size:18px;
    color:#111;
    position:relative;
    appearance:none;
    -webkit-appearance:none;
  }
  .ad-rule-play:hover,
  .ad-step-ball:hover{
    filter:brightness(1.08);
    transform:translateY(-1px);
  }
  .ad-rule-play:focus,
  .ad-step-ball:focus{
    outline:3px solid rgba(58, 107, 214, 0.35);
    outline-offset:2px;
  }
  .ad-rule-play:disabled,
  .ad-step-ball:disabled{
    cursor:not-allowed;
    opacity:0.45;
    filter:grayscale(0.6);
  }
  .ad-step-ball::after{
    content:"";
    width:0;
    height:0;
    border-top:9px solid transparent;
    border-bottom:9px solid transparent;
    border-left:14px solid currentColor;
    position:absolute;
    right:5px;
  }
  .ad-step-ball span{
    position:relative;
    z-index:1;
    color:#0f172a;
    text-shadow:0 1px 0 rgba(255,255,255,0.45);
  }
  .ad-step-ball.green{ background:#0aa13b; color:#0f7c24; }
  .ad-step-ball.red{ background:#e15d5d; color:#b83c3c; }
  .ad-step-ball.orange{ background:#f18a16; color:#c96f0e; }
  .ad-step-ball.purple{ background:#7555a3; color:#5b4281; }
  .ad-step-ball.gray{ background:#8b8f95; color:#686d73; }
  .ad-step-text{
    background:#fff;
    border:1px solid #555;
    min-height:48px;
    padding:7px 10px;
    position:relative;
    font-size:13px;
    line-height:1.45;
  }
  .ad-step-text::before{
    content:"";
    position:absolute;
    left:-13px;
    top:50%;
    transform:translateY(-50%);
    width:0;
    height:0;
    border-top:9px solid transparent;
    border-bottom:9px solid transparent;
    border-right:13px solid #555;
  }
  .ad-step-text::after{
    content:"";
    position:absolute;
    left:-11px;
    top:50%;
    transform:translateY(-50%);
    width:0;
    height:0;
    border-top:8px solid transparent;
    border-bottom:8px solid transparent;
    border-right:12px solid #fff;
  }
  @media (max-width: 600px) {
    .ad-rules-card{ padding:12px; }
    .ad-rule-main{ padding-left:38px; font-size:13px; }
    .ad-step{ grid-template-columns:36px minmax(0, 1fr); gap:8px; }
    .ad-step-ball{ width:34px; height:34px; font-size:16px; }
  }

  .two-col{
    display:grid;
    grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
    gap: 14px;
  }
  @media (max-width: 1100px){ .officer-stats{ grid-template-columns: repeat(2, minmax(0, 1fr)); } }
  @media (max-width: 700px){ .two-col{ grid-template-columns: 1fr; } }
  @media (max-width: 520px){ .officer-stats{ grid-template-columns: 1fr; } }

  .info-card{
    background: var(--header-blue);
    border-radius: var(--card-radius);
    padding: 14px;
  }
  .info-card h4{
    margin:0 0 8px 0; font-size:13px; color:var(--red); font-weight:800; text-align:center;
    border-bottom: 1px dashed #99a; padding-bottom:6px;
  }
  .kisti-box{
    background:#fff; border-radius:8px; padding:10px; margin-top:10px; font-size:12.5px;
  }
  .kisti-box .lbl{ font-weight:800; color:#111; margin-bottom:4px; }
  .kisti-box div{ margin-bottom:3px; color:#333; }

  .map-block{
    margin-top:10px; height:130px; border-radius:8px;
    background: repeating-linear-gradient(45deg, #d9c9ec 0 8px, #eadff5 8px 16px),
                linear-gradient(#e7ddf0,#e7ddf0);
    position:relative; overflow:hidden;
    border: 1px solid #b9a8d0;
  }
  .map-block::after{
    content:"";
    position:absolute; inset:0;
    background: linear-gradient(120deg, transparent 40%, rgba(120,170,220,0.6) 42%, rgba(120,170,220,0.6) 46%, transparent 48%);
  }

  .green-list-card{
    background:#eaf6ea;
    border-radius: var(--card-radius);
    padding: 14px;
  }
  .green-list-card h4{
    margin:0 0 10px 0; font-size:14px; font-weight:800; color:#111; text-align:center;
  }
  .green-list-card ul{ margin:0; padding-left:18px; }
  .green-list-card li{
    font-size:12.5px; color:var(--green); font-weight:700; margin-bottom:7px;
  }
  .green-list-card li.alt{ color:var(--red); }

  .booking-card{
    background:#fff;
    border: 3px solid var(--red);
    border-radius: var(--card-radius);
    padding: 16px 18px;
  }
  .booking-card h4{
    text-align:center; color:var(--red); font-size:17px; font-weight:800; margin:0 0 12px 0;
  }
  .booking-row{
    display:flex; justify-content:space-between; align-items:baseline;
    font-size:15px; margin-bottom:8px; color:#222; font-weight:600;
  }
  .booking-row .val{ font-weight:800; color:#111; }
  .booking-note{ font-size:13px; color:#444; margin-top:6px; }
  .book-btn{
    display:block; margin: 14px auto 0;
    background: #fff; color: var(--green);
    border: 2px solid var(--green); border-radius: 20px;
    padding: 8px 24px; font-weight:800; font-size:14px;
    text-align:center; width:fit-content;
    cursor:pointer;
  }
  .book-btn:hover{ background: var(--green); color:#fff; }

  .officer-stats{
    display:grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap:12px;
  }
  .stat-card{
    background:#fff;
    border:1px solid #dce8f3;
    border-radius:12px;
    padding:14px;
  }
  .stat-label{
    color:#456;
    font-size:12px;
    font-weight:700;
    margin-bottom:4px;
  }
  .stat-value{
    color:#14335c;
    font-size:24px;
    font-weight:800;
  }
  .recent-card{
    background:#fff;
    border-radius:var(--card-radius);
    padding:16px;
  }
  .recent-card h3{
    margin:0 0 12px;
    color:#14335c;
    font-size:18px;
    font-weight:800;
  }
  .recent-table{
    width:100%;
    border-collapse:collapse;
  }
  .recent-table th,
  .recent-table td{
    padding:10px;
    border-bottom:1px solid #e8edf3;
    text-align:left;
    font-size:13px;
  }
  .recent-table th{
    color:#14335c;
    background:#f4f8fb;
  }
  .empty-state{
    margin:0;
    padding:18px;
    color:#607080;
    text-align:center;
    background:#f7fafc;
    border-radius:10px;
  }

  .flat-section{
    background: transparent;
    display:grid;
    grid-template-columns: auto 1fr;
    gap: 16px;
    align-items:start;
  }
  .flat-title{ color:#fff; font-size:22px; font-weight:800; margin:6px 0; }
  .flat-card{
    background:#0e0e0e; border:1px solid #333; border-radius:10px;
    padding: 16px; display:flex; flex-direction:column; gap:14px;
  }
  .flat-item{ display:flex; align-items:center; gap:12px; }
  .flat-icon{
    width:38px;height:38px; border-radius:8px;
    background:#fff; display:flex;align-items:center;justify-content:center;
    flex:none;
  }
  .flat-icon svg{ width:22px;height:22px; }
  .flat-name{ color:var(--red); font-weight:700; font-size:14px; text-decoration: underline wavy var(--red); }
  .flat-name b{ color:#eee; }

  .officer-panel footer.note{
    color:#888; font-size:11px; text-align:center; margin-top:6px;
  }

  /* Booking form sub details */
  .booking-price-table {
    width: 100%;
    margin-top: 8px;
    border-collapse: collapse;
    background: #f5d8d8;
    font-size: 13.5px;
    border: 1px solid #111;
  }
  .booking-price-table th,
  .booking-price-table td {
    border: 1px solid #111;
    padding: 6px;
    text-align: center;
  }
  @if(isset($appSettings))
  .nav-card {
    background: {{ $appSettings->navbar_color }} !important;
  }
  .header-card {
    background: #002b2b !important;
    border-color: {{ $appSettings->header_color }} !important;
  }
  .officer-role {
    color: #e5e7eb !important;
    border-color: {{ $appSettings->header_color }} !important;
  }
  .arrow-dot {
    background: {{ $appSettings->header_color }} !important;
  }
  .book-btn {
    color: {{ $appSettings->header_color }} !important;
    border-color: {{ $appSettings->header_color }} !important;
  }
  .book-btn:hover {
    background: {{ $appSettings->header_color }} !important;
    color: #fff !important;
  }
  .menu-btn.active {
    background: {{ $appSettings->header_color }} !important;
    border-color: {{ $appSettings->header_color }} !important;
  }
  /* Merchant Directory & Catalog styles */
  .merchant-filter-row {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 8px;
    margin-bottom: 12px;
  }
  @media (max-width: 768px) {
    .merchant-filter-row {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  .merchant-filter-row input,
  .merchant-filter-row select {
    height: 36px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 0 8px;
    font-size: 13px;
  }
  .catalog-qty-input {
    width: 70px;
    height: 32px;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    text-align: center;
    padding: 0 4px;
    font-size: 13.5px;
  }
  
  /* Cash Memo styling */
  .memo-wrapper {
    background: #fff;
    border: 2px solid #555;
    padding: 24px;
    color: #111;
    font-family: 'Hind Siliguri', 'Baloo Da 2', sans-serif;
  }
  .memo-header {
    border-bottom: 3px double #111;
    padding-bottom: 12px;
    margin-bottom: 14px;
    text-align: center;
  }
  .memo-title-badge {
    background: #111;
    color: #fff;
    padding: 6px 20px;
    font-weight: 700;
    font-size: 16px;
    margin: 8px auto;
    width: fit-content;
    border-radius: 4px;
    text-transform: uppercase;
  }
  .memo-meta-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    font-size: 14px;
    margin-bottom: 12px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 8px;
    text-align: left;
  }
  .memo-meta-grid div span {
    font-weight: 700;
  }

  /* Compact officer home — the primary dashboard view */
  .officer-panel{
    --bg:#06b9a7;
    --panel-dark:#003b37;
    --navy:#06366c;
    --card-radius:14px;
    min-height:calc(100vh - 69px);
    padding:10px 12px;
    background:var(--bg);
  }
  .officer-app{
    grid-template-columns:minmax(0, 525px) minmax(0, 1fr);
    gap:18px;
    max-width:1550px;
  }
  .left-col{gap:16px;}
  .header-card{
    min-height:352px;
    padding:14px;
    background:var(--panel-dark) !important;
    grid-template-columns:120px minmax(0, 1fr);
    gap:12px;
  }
  .back-arrow{top:14px;left:14px;width:30px;height:27px;background:#3c6bd7;border-radius:4px;}
  .brand-block{padding-top:34px;}
  .avatar{width:96px;height:96px;border:3px solid #4f5b63;}
  .officer-name{margin-top:8px;padding:3px 10px;color:#334155;}
  .officer-role{color:#fff !important;border-color:#e800ff !important;padding:2px 10px;}
  .brand-title{padding-top:2px;}
  .logo-circle{width:38px;height:38px;}
  .brand-name{color:#f31a20;font-size:25px;}
  .brand-sub{color:#78aaff;margin-top:3px;font-size:13px;}
  .brand-tag{color:#fff;margin-top:5px;font-size:14px;}
  .notish{gap:8px;margin-top:5px;}
  .notish-title{font-size:20px;}
  .pill-row{gap:8px;}
  .pill{min-height:38px;padding:5px 12px;border-radius:16px;display:flex;align-items:center;justify-content:center;line-height:1.25;}
  .dot{width:20px;height:20px;}
  .officer-label{color:#fff;font-size:14px;margin-top:2px;}
  .nav-card{
    min-height:460px;
    padding:18px;
    background:var(--panel-dark) !important;
  }
  .nav-top{gap:14px;margin-bottom:16px;}
  .nav-top .about{font-size:18px;}
  .menu-grid{gap:11px 12px;}
  .menu-btn{padding:12px 8px;min-height:45px;border-radius:24px;font-size:15px;}
  .menu-btn.active{background:#ce00ef;color:#fff;}
  .bottom-row{margin-top:16px;color:#fff;}
  @media (max-width:950px){
    .officer-panel{margin:-12px;padding:10px 21px;}
    .officer-app{grid-template-columns:1fr;max-width:525px;}
  }
  @media (max-width:420px){
    .officer-panel{padding:8px;}
    .header-card{grid-template-columns:105px minmax(0,1fr);}
    .brand-name{font-size:20px;}
    .nav-card{padding:14px;}
    .nav-top{gap:9px;}
    .menu-grid{gap:9px;}
    .menu-btn{font-size:13px;}
  }

  /* Live-data workspace replacing the old static project promotion panel */
  .modern-workspace{display:flex;flex-direction:column;gap:18px;color:#0f2447;}
  .modern-hero{min-height:180px;padding:30px;border-radius:20px;color:#fff;display:flex;align-items:flex-end;justify-content:space-between;gap:22px;overflow:hidden;position:relative;background:linear-gradient(120deg,#0c396c,#1268a5 55%,#05ad9b);box-shadow:0 18px 35px rgba(3,37,76,.22);}
  .modern-hero:before,.modern-hero:after{content:"";position:absolute;border-radius:50%;background:rgba(255,255,255,.1);pointer-events:none;}
  .modern-hero:before{width:280px;height:280px;right:-85px;top:-145px;}
  .modern-hero:after{width:170px;height:170px;right:145px;bottom:-115px;}
  .modern-hero > *{position:relative;z-index:1;}
  .modern-eyebrow{display:block;margin-bottom:8px;color:#a9fff5;font-size:12px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;}
  .modern-eyebrow i{font-size:9px;margin-right:5px;}
  .modern-hero h1{margin:0;font-size:clamp(24px,3vw,34px);font-weight:800;line-height:1.13;}
  .modern-hero p{margin:8px 0 0;color:#dceeff;font-size:14px;}
  .modern-primary-action{display:inline-flex;align-items:center;gap:8px;white-space:nowrap;border-radius:11px;padding:12px 16px;background:#fff;color:#12598c;font-size:14px;font-weight:800;text-decoration:none;box-shadow:0 8px 18px rgba(0,0,0,.15);}
  .modern-primary-action:hover{color:#06366c;transform:translateY(-1px);text-decoration:none;}
  .modern-stat-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;}
  .modern-stat-card{min-height:105px;display:flex;align-items:center;gap:13px;padding:17px;background:#fff;border:1px solid #e7edf5;border-radius:16px;box-shadow:0 8px 20px rgba(17,52,91,.08);}
  .modern-stat-icon{width:41px;height:41px;border-radius:12px;display:grid;place-items:center;font-size:17px;flex:none;}
  .modern-stat-card small,.modern-balance-card > span{display:block;color:#64748b;font-size:12px;font-weight:700;}
  .modern-stat-card strong{display:block;margin-top:3px;color:#102e57;font-size:27px;line-height:1;font-weight:800;}
  .modern-stat-card.blue .modern-stat-icon{color:#1475c9;background:#e5f3ff;}.modern-stat-card.amber .modern-stat-icon{color:#bc7902;background:#fff4db;}.modern-stat-card.green .modern-stat-icon{color:#12936a;background:#ddf8ed;}.modern-stat-card.violet .modern-stat-icon{color:#7453bd;background:#eee8ff;}
  .modern-dashboard-grid{display:grid;grid-template-columns:minmax(0,1.65fr) minmax(250px,.9fr);gap:18px;}
  .modern-card{background:#fff;border:1px solid #e7edf5;border-radius:16px;padding:20px;box-shadow:0 8px 20px rgba(17,52,91,.08);}
  .modern-card-head{display:flex;justify-content:space-between;align-items:start;padding-bottom:14px;border-bottom:1px solid #edf1f5;}
  .modern-card-head span:first-child{color:#6f7d91;text-transform:uppercase;letter-spacing:.08em;font-size:10px;font-weight:800;}.modern-card-head h2{margin:4px 0 0;color:#102e57;font-size:19px;font-weight:800;}
  .live-indicator{padding:5px 8px;border-radius:99px;color:#16855e;background:#ddf8ed;font-size:11px;font-weight:800;}.live-indicator:before{content:"";display:inline-block;width:6px;height:6px;margin:0 4px 1px 0;border-radius:50%;background:currentColor;}
  .modern-activity-row{display:flex;align-items:center;gap:12px;padding:13px 0;border-bottom:1px solid #f0f3f7;}.modern-activity-row:last-child{border:0;padding-bottom:0;}.activity-dot{width:31px;height:31px;border-radius:10px;display:grid;place-items:center;color:#1a79bf;background:#e9f5ff;font-size:13px;}.modern-activity-row strong,.modern-activity-row small{display:block;}.modern-activity-row strong{color:#203653;font-size:13px;}.modern-activity-row small{margin-top:3px;color:#8491a3;font-size:11px;}
  .modern-empty{text-align:center;padding:29px 12px;color:#7b8797;}.modern-empty i{font-size:25px;color:#a9b8c9;}.modern-empty p{margin:9px 0 3px;color:#405572;font-weight:800;}.modern-empty span{font-size:12px;}
  .modern-balance-card{color:#fff;border:0;background:linear-gradient(145deg,#153b70,#0b2760);}.modern-balance-card > span{color:#b8d3f3;}.modern-balance-card > strong{display:block;margin:7px 0 18px;font-size:28px;line-height:1.1;}.modern-balance-row{display:flex;justify-content:space-between;padding:10px 0;border-top:1px solid rgba(255,255,255,.16);color:#c4d7ee;font-size:13px;}.modern-balance-row b{color:#fff;}.modern-text-action{display:block;width:100%;margin-top:14px;padding:0;border:0;background:transparent;color:#75e6db;text-align:left;font-size:12px;font-weight:800;cursor:pointer;text-decoration:none;}.modern-text-action:hover{color:#b7fff8;text-decoration:none;}.modern-text-action i{margin-left:5px;}
  @media(max-width:800px){.modern-stat-grid{grid-template-columns:repeat(2,minmax(0,1fr));}.modern-dashboard-grid{grid-template-columns:1fr;}}
  @media(max-width:520px){.modern-hero{min-height:205px;padding:22px;align-items:flex-start;flex-direction:column;justify-content:space-between;}.modern-primary-action{width:100%;justify-content:center;}.modern-stat-grid{gap:10px;}.modern-stat-card{min-height:90px;padding:13px;gap:9px;}.modern-stat-icon{width:34px;height:34px;border-radius:10px;font-size:14px;}.modern-stat-card strong{font-size:22px;}.modern-card{padding:16px;}}

  .dashboard-services{padding:20px;border-radius:20px;background:linear-gradient(145deg,#102f4d,#061b32);box-shadow:0 18px 35px rgba(3,30,59,.2);}
  .services-label{margin:0 5px 18px;color:#9ecbfa;font-size:12px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;}
  .services-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;}
  .service-tile{min-height:118px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;padding:14px 8px;border:1px solid rgba(174,210,244,.16);border-radius:16px;background:rgba(105,154,199,.13);color:#fff;font:800 14px/1.2 'Hind Siliguri',sans-serif;cursor:pointer;transition:transform .18s ease,background .18s ease,border-color .18s ease;}
  .service-tile:hover{transform:translateY(-3px);background:rgba(105,154,199,.24);border-color:rgba(174,210,244,.3);}
  .service-tile span{width:52px;height:52px;display:grid;place-items:center;border-radius:15px;color:#fff;font-size:20px;box-shadow:inset 0 1px rgba(255,255,255,.22),0 8px 15px rgba(0,0,0,.13);}
  .service-tile.sky span{background:linear-gradient(135deg,#55b8ff,#2584de);}.service-tile.emerald span{background:linear-gradient(135deg,#45e396,#10a961);}.service-tile.rose span{background:linear-gradient(135deg,#ff7592,#ef315e);}.service-tile.gold span{background:linear-gradient(135deg,#ffd557,#eea907);}.service-tile.violet span{background:linear-gradient(135deg,#a57aff,#7135df);}.service-tile.orange span{background:linear-gradient(135deg,#ffae6d,#f26924);}.service-tile.cyan span{background:linear-gradient(135deg,#6bcbff,#2994d9);}.service-tile.pink span{background:linear-gradient(135deg,#fa8fba,#df3f7c);}.service-tile.green span{background:linear-gradient(135deg,#57e995,#08ae68);}.service-tile.blue span{background:linear-gradient(135deg,#89b2ff,#4d77dd);}.service-tile.yellow span{background:linear-gradient(135deg,#ffd86a,#f2a30c);}
  .services-footer{display:flex;align-items:center;justify-content:space-between;margin-top:20px;padding-top:17px;border-top:1px solid rgba(174,210,244,.14);color:#bed3e9;font-size:13px;font-weight:700;}.services-footer b{margin-right:16px;color:#3ef0aa;}.services-footer em{font-style:normal;}.services-footer form{margin:0;}.services-footer button{padding:0;border:0;background:transparent;color:#ff94b3;font-size:13px;font-weight:800;cursor:pointer;}.services-footer button i{margin-right:5px;}
  @media(max-width:640px){.dashboard-services{padding:15px;}.services-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:9px;}.service-tile{min-height:100px;font-size:13px;}.service-tile span{width:43px;height:43px;border-radius:13px;font-size:17px;}}

  .registration-category-panel{margin-top:18px;padding:22px;background:#fff;border:1px solid #e2eaf2;border-radius:18px;box-shadow:0 10px 26px rgba(14,42,71,.1);}.registration-panel-head{display:flex;justify-content:space-between;align-items:start;margin-bottom:16px;}.registration-panel-head span{color:#16a164;font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;}.registration-panel-head h2{margin:3px 0 0;color:#102e57;font-size:20px;font-weight:800;}.registration-panel-close{width:30px;height:30px;border:0;border-radius:50%;background:#edf3f8;color:#46617d;font-size:23px;line-height:1;cursor:pointer;}.registration-category-options{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;}.registration-category-option{display:flex;align-items:center;gap:10px;padding:13px;border:1px solid #dbe5ef;border-radius:11px;cursor:pointer;transition:.15s;}.registration-category-option input{position:absolute;opacity:0;}.radio-mark{width:18px;height:18px;border:2px solid #91a4b8;border-radius:50%;flex:none;}.registration-category-option input:checked + .radio-mark{border-color:#159b65;box-shadow:inset 0 0 0 4px #fff;background:#159b65;}.registration-category-option:has(input:checked){border-color:#159b65;background:#effbf5;}.registration-category-option strong,.registration-category-option small{display:block;}.registration-category-option strong{color:#17375d;font-size:14px;}.registration-category-option small{margin-top:2px;color:#70849a;font-size:11px;}.registration-followup{margin-top:16px;padding:14px;border-radius:11px;background:#f4f8fc;color:#23456c;}.registration-followup p{margin:0 0 10px;font-weight:800;}.registration-level{margin-right:8px;padding:8px 15px;border:0;border-radius:8px;background:#1a7d2e;color:#fff;font-weight:800;cursor:pointer;}.registration-empty{text-align:center;color:#718197;margin:0;}.officer-dashboard-only.registration-workspace-open .right-col > .workspace-section.active{display:flex !important;}
  .property-category-list{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:11px;}.property-category-item{display:flex;align-items:center;gap:12px;padding:14px;border:1px solid #dbe5ef;border-radius:12px;background:#fbfdff;}.property-category-icon{width:39px;height:39px;display:grid;place-items:center;flex:none;border-radius:10px;color:#138f67;background:#e2f8ef;font-size:17px;}.property-category-item strong{display:block;color:#17375d;font-size:14px;}.property-category-item p{margin:3px 0 0;color:#71849a;font-size:11px;line-height:1.35;}
  @media(max-width:520px){.registration-category-options,.property-category-list{grid-template-columns:1fr;}.registration-category-panel{padding:16px;}}

  /* Officer dashboard-only mode */
  .officer-dashboard-only .officer-app{grid-template-columns:minmax(270px,330px) minmax(0,1fr);align-items:start;}
  .officer-dashboard-only .nav-card,
  .officer-dashboard-only .sub-panels,
  .officer-dashboard-only .right-col > .workspace-section:not(#ws-fatherland){display:none !important;}
  .officer-dashboard-only .header-card{min-height:0;grid-template-columns:120px minmax(0,1fr);justify-items:stretch;text-align:left;}
  .officer-dashboard-only .back-arrow{display:none;}
  .officer-dashboard-only .brand-title{grid-column:1 / -1;grid-row:1;padding-top:0;text-align:center;}
  .officer-dashboard-only .brand-logo-row{justify-content:center;}
  .officer-dashboard-only .brand-block{grid-column:1;grid-row:2;padding-top:10px;align-self:start;}
  .officer-dashboard-only .notish{grid-column:2;grid-row:2;width:100%;margin-top:10px;}
  .officer-dashboard-only .notish-title,.officer-dashboard-only .officer-label{text-align:left;}
  .officer-dashboard-only .pill{min-height:38px;}
  .officer-dashboard-only .letter-row{grid-column:1 / -1;grid-row:3;margin-top:7px;}
  .officer-dashboard-only .officer-label{grid-column:1 / -1;grid-row:4;margin-top:3px;}
  @media(max-width:950px){.officer-dashboard-only .officer-app{grid-template-columns:1fr;}.officer-dashboard-only .brand-block{padding-top:10px;}}
  @media(max-width:380px){.officer-dashboard-only .header-card{grid-template-columns:1fr;}.officer-dashboard-only .brand-block,.officer-dashboard-only .notish,.officer-dashboard-only .letter-row,.officer-dashboard-only .officer-label{grid-column:1;}.officer-dashboard-only .brand-block{grid-row:2;justify-self:center;}.officer-dashboard-only .notish{grid-row:3;}.officer-dashboard-only .letter-row{grid-row:4;}.officer-dashboard-only .officer-label{grid-row:5;}}
  @endif
</style>
@endpush

@section('content')
@php
  $officerInitials = collect(explode(' ', $officer->name))->filter()->take(2)->map(fn ($part) => mb_substr($part, 0, 1))->implode('');
  $balanceView = isset($appSettings) ? ($appSettings->balance_view ?? 'open') : 'open';
  $balanceLabel = $balanceView === 'hold' ? 'Hold' : number_format($stats['balance'], 2);
@endphp

<div class="officer-panel officer-dashboard-only">
<div class="officer-app">

  <!-- ======================= LEFT COLUMN ======================= -->
  <div class="left-col">

    <div class="header-card">
      <div class="back-arrow">&#8592;</div>

      <div class="brand-block">
        <div class="avatar">
          @if($officer->profile_image)
            <img src="{{ asset($officer->profile_image) }}" alt="Avatar">
          @else
            {{ $officerInitials ?: 'OF' }}
          @endif
        </div>
        <div class="officer-name" title="{{ $officer->name }}">{{ $officer->name }}</div>
        <div class="officer-role">Officer</div>
      </div>

      <div class="brand-title">
        <div class="brand-logo-row">
          <div class="logo-circle" style="overflow:hidden; display:flex; align-items:center; justify-content:center;">
            @if(isset($appSettings) && $appSettings->logo)
              <img src="{{ asset($appSettings->logo) }}" alt="Logo" style="max-width:100%; max-height:100%; object-fit:contain;">
            @else
              MB
            @endif
          </div>
          <div>
            <div class="brand-name">{{ isset($appSettings) ? $appSettings->brand_name : 'MBC Bangladesh.com' }}</div>
          </div>
        </div>
        <div class="brand-sub">Multiple Business Community</div>
      </div>

      <div class="notish">
        <div class="notish-title">Notice</div>
        <div class="point-actions">
          <div class="pill-row menu-trigger" data-ws="ws-point-store" data-menu="point-store"><span class="pill">Shopping Point: {{ number_format($stats['shopping_points']) }}</span><span class="dot pink"></span></div>
          <div class="pill-row menu-trigger" data-ws="ws-point-store" data-menu="point-store"><span class="pill">Payout Point: {{ $balanceLabel }}</span><span class="dot yellow"></span></div>
          <div class="pill-row"><span class="pill">Deposit: {{ number_format($stats['deposit'], 2) }}</span><span class="dot blue"></span></div>
          <div class="pill-row"><span class="pill">Profit: {{ number_format($stats['profit'], 2) }}</span><span class="dot orange"></span></div>
        </div>
      </div>
      <div class="letter-row" aria-label="Officer level navigation">
        <button class="letter-button active" type="button">A <span>▶</span></button>
        <button class="letter-button" type="button">B <span>▶</span></button>
        <button class="letter-button" type="button">C <span>▶</span></button>
        <button class="letter-button" type="button">D <span>▶</span></button>
        <button class="letter-button" type="button">E <span>▶</span></button>
      </div>
      <div class="officer-label">Officer</div>
    </div>

    <div class="nav-card">
      <div class="nav-top">
        <span class="about">Abut US</span>
        <span class="icon-btn gear">&#9881;</span>
        <a class="icon-btn profile-txt" href="{{ route('officer.profile') }}">Profile</a>
        <a class="icon-btn play" href="{{ isset($appSettings) && $appSettings->social_youtube ? $appSettings->social_youtube : '#' }}" target="_blank">&#9654;</a>
        <a class="icon-btn fb" href="{{ isset($appSettings) && $appSettings->social_facebook ? $appSettings->social_facebook : '#' }}" target="_blank">f</a>
        <a class="icon-btn team" href="{{ isset($appSettings) && $appSettings->social_community ? $appSettings->social_community : '#' }}" target="_blank">&#128101;</a>
        <a class="icon-btn chat" href="{{ isset($appSettings) && $appSettings->social_messenger ? $appSettings->social_messenger : '#' }}" target="_blank">&#128172;</a>
      </div>

      <div class="menu-grid">
        <a class="menu-btn active" href="#" data-sub="sp-projects" data-ws="ws-fatherland" id="btn-menu-projects">Land Project</a>
        <a class="menu-btn" href="#" data-sub="sp-flats" data-ws="ws-flat-shonno-1">Our Flat</a>
        <a class="menu-btn" href="#">E-Shop</a>
        <a class="menu-btn" href="#">Hotel &amp; Restaurant</a>
        <a class="menu-btn" href="#">Father Shop</a>
        <a class="menu-btn" href="#">Investment</a>
        <a class="menu-btn" href="#" data-ws="ws-merchant-list" id="btn-menu-merchant-trigger">Merchant</a>
        <a class="menu-btn" href="#" data-sub="sp-registration" data-ws="ws-form-agent" id="btn-menu-agent-trigger">Agent</a>
        <a class="menu-btn" href="#" data-sub="sp-registration" data-ws="ws-form-customer-l1" id="btn-menu-registration">Registration</a>
        <a class="menu-btn" href="#" data-ws="ws-point-store" id="btn-menu-point-store">Point Store</a>
        <a class="menu-btn" href="#" data-ws="ws-packages" id="btn-menu-packages">Packages</a>
        <a class="menu-btn" href="#" data-ws="ws-rank-report" id="btn-menu-rank-report">Rank Report</a>
      </div>

      <div class="bottom-row">
        <span>New / Adjusting</span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-txt" style="background:transparent;border:0;color:inherit;padding:0;">Logout</button>
        </form>
      </div>
    </div>

    <!-- LEFT SUB-PANELS CONTAINER -->
    <div class="sub-panels">
      
      <!-- Sub Panel: Land Projects -->
      <div id="sp-projects" class="sub-panel-card">
        <div class="sub-card">
          <h3>Land Project</h3>
          <ul class="sub-nav-list">
            <li><a href="#" class="sub-link" data-ws="ws-mbc-properties">MBC Properties</a></li>
            <li><a href="#" class="sub-link active" data-ws="ws-fatherland">Fatherland Homes Limited</a></li>
            <li><a href="#" class="sub-link" data-ws="ws-maryland">Maryland Homes LTD</a></li>
            <li><a href="#" class="sub-link" data-ws="ws-eden">Eden River City</a></li>
          </ul>
        </div>
      </div>

      <!-- Sub Panel: Flats -->
      <div id="sp-flats" class="sub-panel-card" style="display:none;">
        <div class="sub-card">
          <h3>Our Flat</h3>
          <ul class="sub-nav-list">
            <li><a href="#" class="sub-link" data-ws="ws-flat-shonno-1">Shonno Chura-1 (Shanar par)</a></li>
            <li><a href="#" class="sub-link" data-ws="ws-flat-shonno-2">Shonno Chura-2 (Keraniganj)</a></li>
            <li><a href="#" class="sub-link" data-ws="ws-flat-prohashi-1">Prohashi Polly-1 (Prohashi City)</a></li>
            <li><a href="#" class="sub-link" data-ws="ws-flat-prohashi-2">Prohashi Polly-2 (Dhaka-Mawoa Road)</a></li>
          </ul>
        </div>
      </div>

      <!-- Sub Panel: Registration Types -->
      <div id="sp-registration" class="sub-panel-card" style="display:none;">
        <div class="sub-card">
          <h3>Registration</h3>
          <ul class="sub-nav-list">
            <li><a href="#" class="sub-link" data-ws="ws-form-officer">Officer</a></li>
            <li class="has-badges">
              <span>Customer</span>
              <div class="level-badges">
                <a href="#" class="level-chip sub-link active" data-ws="ws-form-customer-l1">Level-1</a>
                <a href="#" class="level-chip sub-link" data-ws="ws-form-customer-l2">Level-2</a>
              </div>
            </li>
            <li><a href="#" class="sub-link" data-ws="ws-form-agent" id="sub-link-agent">Agent</a></li>
            <li><a href="#" class="sub-link" data-ws="ws-form-merchant" id="sub-link-merchant">Merchant</a></li>
          </ul>
        </div>
      </div>

    </div>

  </div>

  <!-- ======================= RIGHT COLUMN ======================= -->
  <div class="right-col">
   <section class="dashboard-services" aria-labelledby="business-services-heading">
          <div class="services-label" id="business-services-heading">Business services</div>
          <div class="services-grid">
            <button type="button" class="service-tile sky land-project-service"><span><i class="fa fa-map-marker"></i></span>Land Project</button>
            <button type="button" class="service-tile emerald"><span><i class="fa fa-building-o"></i></span>Our Flat</button>
            <button type="button" class="service-tile rose"><span><i class="fa fa-shopping-bag"></i></span>E-Shop</button>
            <button type="button" class="service-tile gold"><span><i class="fa fa-cutlery"></i></span>Hotel &amp; Restaurant</button>
            <button type="button" class="service-tile violet"><span><i class="fa fa-shopping-basket"></i></span>Father Shop</button>
            <button type="button" class="service-tile orange"><span><i class="fa fa-line-chart"></i></span>Investment</button>
            <button type="button" class="service-tile cyan"><span><i class="fa fa-store"></i></span>Merchant</button>
            <button type="button" class="service-tile pink"><span><i class="fa fa-users"></i></span>Agent</button>
            <button type="button" class="service-tile green registration-service"><span><i class="fa fa-user-plus"></i></span>Registration</button>
            <button type="button" class="service-tile blue"><span><i class="fa fa-star-o"></i></span>Point Store</button>
            <button type="button" class="service-tile yellow"><span><i class="fa fa-cubes"></i></span>Packages</button>
          </div>
          <div class="services-footer"><span><b>New</b> <em>Adjusting</em></span><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"><i class="fa fa-sign-out"></i> Logout</button></form></div>
        </section>

        <section id="registration-category-panel" class="registration-category-panel" hidden>
          <div class="registration-panel-head"><div><span>Registration</span><h2>Choose a registration category</h2></div><button type="button" class="registration-panel-close" aria-label="Close">&times;</button></div>
          <div class="registration-category-options">
            @forelse($registrationCategories as $category)
              <label class="registration-category-option"><input type="radio" name="registration_category" value="{{ \Illuminate\Support\Str::lower($category->name) }}"><span class="radio-mark"></span><span><strong>{{ $category->name }}</strong>@if($category->description)<small>{{ $category->description }}</small>@endif</span></label>
            @empty
              <p class="registration-empty">No registration category is available.</p>
            @endforelse
          </div>
          <div id="officer-label-options" class="registration-followup" hidden><p>Select officer label</p><button type="button" class="registration-level" data-workspace="ws-form-officer">Label-1</button><button type="button" class="registration-level" data-workspace="ws-form-officer">Label-2</button></div>
          <div id="agent-empty-state" class="registration-followup" hidden><i class="fa fa-clock-o"></i><p>Agent registration will be available later.</p></div>
        </section>

        <section id="property-category-panel" class="registration-category-panel" hidden>
          <div class="registration-panel-head"><div><span>Land Project</span><h2>Property categories</h2></div><button type="button" class="property-panel-close registration-panel-close" aria-label="Close">&times;</button></div>
          <div class="property-category-list">
            @forelse($propertyCategories as $category)
              <article class="property-category-item"><span class="property-category-icon"><i class="fa fa-building-o"></i></span><div><strong>{{ $category->name }}</strong><p>{{ $category->description ?: 'Property category' }}</p></div></article>
            @empty
              <p class="registration-empty">No property category is available.</p>
            @endforelse
          </div>
        </section>

    <!-- Workspace 1: Fatherland Homes Limited (Default View) -->
    <div id="ws-fatherland" class="workspace-section active">
      <section class="modern-workspace">
        <div class="modern-hero">
          <div>
            <span class="modern-eyebrow"><i class="fa fa-circle"></i> Officer workspace</span>
            <h1>Welcome back, {{ $officer->name }}</h1>
            <p>Your live performance and customer activity, all in one place.</p>
          </div>
          <a href="{{ route('officer.booking-form') }}" class="modern-primary-action">
            <i class="fa fa-plus"></i> New booking
          </a>
        </div>

        <div class="modern-stat-grid">
          <article class="modern-stat-card blue">
            <span class="modern-stat-icon"><i class="fa fa-folder-open"></i></span>
            <div><small>Assigned records</small><strong>{{ number_format($stats['assigned_records']) }}</strong></div>
          </article>
          <article class="modern-stat-card amber">
            <span class="modern-stat-icon"><i class="fa fa-clock-o"></i></span>
            <div><small>Awaiting review</small><strong>{{ number_format($stats['pending_records']) }}</strong></div>
          </article>
          <article class="modern-stat-card green">
            <span class="modern-stat-icon"><i class="fa fa-check"></i></span>
            <div><small>Approved records</small><strong>{{ number_format($stats['approved_records']) }}</strong></div>
          </article>
          <article class="modern-stat-card violet">
            <span class="modern-stat-icon"><i class="fa fa-bell-o"></i></span>
            <div><small>Notifications</small><strong>{{ number_format($stats['unread_notifications']) }}</strong></div>
          </article>
        </div>

      
      </section>

      {{-- Legacy project promotion content intentionally removed; this workspace now renders only live officer data. --}}
      {{--
      <div class="project-title"><span class="marker">O</span> Fatherland Homes Limited</div>

      <div class="hero-banner">
        <div class="hero-badge">
          <div class="bn">ফাদারল্যান্ড রিভার ভিউ সিটি</div>
          <div class="en">Fatherland Homes Limited</div>
        </div>
      </div>

      <div class="promo-row">
        <span class="link-text">আমাদের প্রজেক্ট পছন্দের কারণ ও সুবিধাসমূহ</span>
        <span class="circle-btn red">&#9654;</span>
        <span class="circle-btn fb">f</span>
      </div>

      <div class="ad-rules-card">
        <div class="ad-rule-main">
          <button type="button" class="ad-rule-play ad-ball-action" data-ball="Main" title="Add Advertise" {{ isset($appSettings) && ! $appSettings->advertise_enabled ? 'disabled' : '' }}>&#9654;</button>
          <p>
            এডভিট বল পাওয়ার নিয়ম। নিচের আইডি একটিভ হলে এডভিট <span class="ad-rule-red">A</span> রঙ প্রাপ্ত হবে।
            মেয়াদ থাকবে ১ মাস। প্রথম ধাপের ৩ জন একটিভ হলে এডভিট <span class="ad-rule-red">B</span> রঙ প্রাপ্ত হবে।
            দ্বিতীয় ধাপের ৩ জন একটিভ হলে এডভিট <span class="ad-rule-red">C</span> রঙ প্রাপ্ত হবে।
            প্রথম ধাপের সদস্যদের মাধ্যমে এডভিট <span class="ad-rule-red">D</span> এবং <span class="ad-rule-red">E</span> বল অর্জন করা যাবে।
            প্রতিটি ধাপে নির্দিষ্ট বিজ্ঞাপন সাবমিট করলে পয়েন্ট যোগ হবে এবং সময়সীমা অনুযায়ী সুবিধা পাওয়া যাবে।
          </p>
        </div>

        <div class="ad-steps">
          <div class="ad-step">
            <button type="button" class="ad-step-ball green ad-ball-action" data-ball="A" title="Add Advertise for A" {{ isset($appSettings) && ! $appSettings->advertise_enabled ? 'disabled' : '' }}><span>A</span></button>
            <div class="ad-step-text">একজন ব্যক্তি অফলাইনে আইডি একটিভ করলে এডভিট সবুজ পাবেন। প্রতিদিন ১টি বিজ্ঞাপন সাবমিট করে ৫০ পয়েন্ট পাবেন। ১ মাস পর বন্ধ।</div>
          </div>
          <div class="ad-step">
            <button type="button" class="ad-step-ball red ad-ball-action" data-ball="B" title="Add Advertise for B" {{ isset($appSettings) && ! $appSettings->advertise_enabled ? 'disabled' : '' }}><span>B</span></button>
            <div class="ad-step-text">তার আইডির নিচে ৩টি আইডি একটিভ হলে তিনি ২য় এডভিট বল পাবেন। প্রতিদিন ১টি বিজ্ঞাপন সাবমিট করে ৫০ পয়েন্ট করে ১ বছর পর্যন্ত।</div>
          </div>
          <div class="ad-step">
            <button type="button" class="ad-step-ball orange ad-ball-action" data-ball="C" title="Add Advertise for C" {{ isset($appSettings) && ! $appSettings->advertise_enabled ? 'disabled' : '' }}><span>C</span></button>
            <div class="ad-step-text">তার আইডির নিচে আরও ৩টি আইডি একটিভ হলে তিনি ৩য় এডভিট বল পাবেন। তার থেকেও প্রতিদিন ৫০ পয়েন্ট করে ১ বছর পর্যন্ত।</div>
          </div>
          <div class="ad-step">
            <button type="button" class="ad-step-ball purple ad-ball-action" data-ball="D" title="Add Advertise for D" {{ isset($appSettings) && ! $appSettings->advertise_enabled ? 'disabled' : '' }}><span>D</span></button>
            <div class="ad-step-text">প্রথম ধাপের ৩ জনের যে কোনো জনকে ১টি করে এডভিট বল অর্জন করাতে পারলে তিনি ৪র্থ এডভিট বল পাবেন। তার থেকে প্রতিদিন ১০০ পয়েন্ট করে পাবেন ১ বছর পর্যন্ত।</div>
          </div>
          <div class="ad-step">
            <button type="button" class="ad-step-ball gray ad-ball-action" data-ball="E" title="Add Advertise for E" {{ isset($appSettings) && ! $appSettings->advertise_enabled ? 'disabled' : '' }}><span>E</span></button>
            <div class="ad-step-text">প্রথম ধাপের ৩ জনের বাকি সদস্যদের ১টি করে এডভিট বল অর্জন করাতে পারলে তিনি আরও এডভিট বল পাবেন। তার থেকে প্রতিদিন ১০০ পয়েন্ট করে পাবেন ১ বছর পর্যন্ত।</div>
          </div>
        </div>
      </div>

      <div class="officer-stats">
        <div class="stat-card">
          <div class="stat-label">Assigned Records</div>
          <div class="stat-value">{{ number_format($stats['assigned_records']) }}</div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Pending Records</div>
          <div class="stat-value">{{ number_format($stats['pending_records']) }}</div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Approved Records</div>
          <div class="stat-value">{{ number_format($stats['approved_records']) }}</div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Unread Notice</div>
          <div class="stat-value">{{ number_format($stats['unread_notifications']) }}</div>
        </div>
      </div>

      @if($stats['assigned_records'] === 0)
        <div class="ws-card" style="color:#64748b;font-weight:700;text-align:center;">No records found</div>
      @endif

      <div class="two-col">
        <div>
          <div class="info-card">
            <h4>প্লট বিক্রয়/ক্রয়ের নিয়মঃ<br>এককালীন/কিস্তি</h4>
            <div class="kisti-box">
              <div class="lbl">এককালীন:</div>
              <div>ক্রয়ের ক্ষেত্রে ডাউন পেমেন্ট মোট মূল্যের ৫০% টাকা পরিশোধ করতে হবে। অবশিষ্ট ৫০% টাকা সরকারি ৯০ দিনের মধ্যে পরিশোধ করে দলিল/খতিয়ান রেজিস্ট্রি করে নিতে পারবেন।</div>
            </div>
            <div class="kisti-box" style="margin-top:8px;">
              <div class="lbl">কিস্তি:</div>
              <div>* ৬ বছর = ৭২ কিস্তি।</div>
              <div>* ৯ বছর = ১০৮ কিস্তি।</div>
              <div>* ১২ বছর = ১৪৪ কিস্তি।</div>
            </div>
            <div class="map-block"></div>
          </div>
        </div>

        <div class="green-list-card">
          <h4>প্রজেক্টের পাশেই রয়েছে</h4>
          <ul>
            <li>স্কুল, কলেজ, ইউনিভার্সিটি, মাদ্রাসা</li>
            <li>রাজউক ঝিলমিল প্রকল্প</li>
            <li>পাসপোর্ট অফিস</li>
            <li>জগন্নাথ বিশ্ববিদ্যালয় ক্যাম্পাস</li>
            <li>ধলেশ্বরী রিভার ক্যাম্পাস</li>
            <li class="alt">ঢাকা পুলিশ H.Q</li>
            <li class="alt">ঢাকা প্রজেক্ট</li>
            <li class="alt">নিমতলা রেল স্টেশন</li>
            <li>অলিম্পিক ভিলেজ</li>
            <li>স্টেডিয়াম</li>
            <li>বঙ্গবন্ধু স্যাটেলাইট সিটি</li>
            <li class="alt">আন্তর্জাতিক সম্মেলন কেন্দ্র</li>
            <li>বিভিন্ন আবাসিক হোটেল এবং রিসোর্ট</li>
            <li>ধলেশ্বরী নদী ও নদীপথ, ৪০০ ফিট এক্সপ্রেসওয়ে, রেল লাইন ও রেলস্টেশন</li>
          </ul>
        </div>
      </div>

      <div class="booking-card">
        <h4>প্লট বুকিং সংক্রান্ত তথ্যঃ</h4>
        <div class="booking-row"><span>কাঠা প্রতি বুকিং মানি</span><span class="val">= {{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</span></div>
        <div class="booking-row"><span>কাঠা প্রতি ডাউন পেমেন্ট</span><span class="val">= ১,০০,০০০/-</span></div>
        <div class="booking-row"><span>কাঠা প্রতি মোট</span><span class="val">= {{ isset($appSettings) ? number_format($appSettings->booking_money + 100000) : '১,২০,০০০' }}/-</span></div>
        <div class="booking-note">প্রদানের পর অবশিষ্ট টাকা এককালীন অথবা সর্বোচ্চ ১২ বছরে ১৪৪ কিস্তিতে পরিশোধের সুবিধা।</div>
        <div class="book-btn" onclick="$('#btn-menu-registration').click();">বুকিং করুন</div>
      </div>
    --}}
    </div>

    <!-- Workspace 2: MBC Properties / Officers' City -->
    <div id="ws-mbc-properties" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> MBC Properties</div>
      
      <div class="ws-card">
        <h3 style="color:var(--red);">Officers' City</h3>
        <p style="font-weight:700;color:var(--navy);font-size:15px;margin-bottom:10px;">Keyain, Sirajdikhan, Munshiganj</p>
        <p style="font-size:14px;line-height:1.6;color:#555;margin-bottom:20px;">
          Officers' City "শুধুমাত্র বাজেটের অভিজাতদের জন্য" প্রজেক্টটি ঢাকা মাওয়া এক্সপ্রেসওয়ের পাশেই অবস্থিত। অত্যন্ত পরিকল্পিত এবং আধুনিক নাগরিক সুযোগ-সুবিধা সম্বলিত একটি নির্ভরযোগ্য আবাসন প্রকল্প।
        </p>

        <h4 style="margin:20px 0 10px;font-weight:800;color:var(--navy);">Level-1 Packages</h4>
        <div class="table-responsive">
          <table class="ws-table">
            <thead>
              <tr>
                <th>Package Name</th>
                <th>Price / Installment</th>
                <th>Booking Money</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ক্ল্যাসিক জমি মালিকানা</td>
                <td>৳ ৭,৪০,০০০ / ৭২ কিস্তি</td>
                <td>৳ {{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
                <td><button class="level-chip active mock-purchase-btn" data-pkg="ক্ল্যাসিক জমি মালিকানা">Submit</button></td>
              </tr>
              <tr>
                <td>১ শতক জমি</td>
                <td>৳ ২,২০,০০০ / ৭২ কিস্তি</td>
                <td>৳ {{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
                <td><button class="level-chip active mock-purchase-btn" data-pkg="১ শতক জমি">Submit</button></td>
              </tr>
              <tr>
                <td>এক কাঠা প্লট</td>
                <td>৳ ১৭,০০,০০০ / ১২০ কিস্তি</td>
                <td>৳ {{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
                <td><button class="level-chip active mock-purchase-btn" data-pkg="এক কাঠা প্লট">Submit</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Workspace 3: Maryland Homes LTD -->
    <div id="ws-maryland" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Maryland Homes LTD</div>
      <div class="ws-card">
        <h3>Maryland Homes LTD</h3>
        <p style="color:#555;line-height:1.5;">Modern community housing project on Mawa Expressway offering premium residential blocks, security features, and community parks.</p>
        <div class="kisti-box" style="margin-top:14px;background:#f8fafc;border:1px solid #e2e8f0;">
          <div class="lbl" style="color:var(--red);">Contact Details:</div>
          <div>For custom pricing and blocks options, please contact Maryland Homes division manager.</div>
        </div>
      </div>
    </div>

    <!-- Workspace 4: Eden River City -->
    <div id="ws-eden" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Eden River City</div>
      <div class="ws-card">
        <h3>Eden River City</h3>
        <p style="color:#555;line-height:1.5;">Luxurious waterfront plots located in Keraniganj with quick access to the Dhaka 400ft Expressway.</p>
        <div class="kisti-box" style="margin-top:14px;background:#f8fafc;border:1px solid #e2e8f0;">
          <div class="lbl" style="color:var(--green);">Project Highlights:</div>
          <div>Surrounded by green landscape, playgrounds, schools, and direct connection to Nimtola station.</div>
        </div>
      </div>
    </div>

    <!-- Workspace 5: Flat Details -->
    <div id="ws-flat-shonno-1" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Shonno Chura-1</div>
      <div class="ws-card">
        <h3>Shonno Chura-1 (Shanar par)</h3>
        <p>Premium flats in Shanar par featuring state of the art elevators, car parking, and generator backups.</p>
      </div>
    </div>
    <div id="ws-flat-shonno-2" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Shonno Chura-2</div>
      <div class="ws-card">
        <h3>Shonno Chura-2 (Keraniganj)</h3>
        <p>Modern luxury flats near Rajuk Jhilmil project offering dynamic access and green views.</p>
      </div>
    </div>
    <div id="ws-flat-prohashi-1" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Prohashi Polly-1</div>
      <div class="ws-card">
        <h3>Prohashi Polly-1 (Prohashi City)</h3>
        <p>Exclusive apartment units custom built for expatriate members.</p>
      </div>
    </div>
    <div id="ws-flat-prohashi-2" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Prohashi Polly-2</div>
      <div class="ws-card">
        <h3>Prohashi Polly-2 (Dhaka-Mawoa Road)</h3>
        <p>Comfortable duplex flats alongside the high-speed Mawoa expressway.</p>
      </div>
    </div>

    <!-- Workspace 6: Point Store -->
    <div id="ws-point-store" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Point Store</div>
      <div class="ws-card">
        <h3>Point Store Overview</h3>
        <div class="table-responsive">
          <table class="ws-table">
            <thead>
              <tr>
                <th>NO</th>
                <th>Commission Details</th>
                <th>Point</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>01</td><td>Refer</td><td>500</td></tr>
              <tr><td>02</td><td>Add View</td><td>150</td></tr>
              <tr><td>03</td><td>Generation</td><td>200</td></tr>
              <tr><td>04</td><td>Booking</td><td>1,000</td></tr>
              <tr><td>05</td><td>Down Payment</td><td>1,500</td></tr>
              <tr><td>06</td><td>Installment</td><td>300</td></tr>
              <tr><td>07</td><td>Flash Back</td><td>500</td></tr>
              <tr class="total-row"><td></td><td>Total Point</td><td>4,150</td></tr>
              <tr class="total-row"><td></td><td>Total Payout (৳)</td><td>3,500</td></tr>
              <tr class="highlight-orange"><td></td><td>Adjustable Point</td><td>650</td></tr>
              <tr class="highlight-green"><td></td><td>Shop Point</td><td>500</td></tr>
              <tr class="highlight-green"><td></td><td>Payout Point</td><td>3,000</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Workspace: Officer Wise Rank Report -->
    <div id="ws-rank-report" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Rank &amp; Commission</div>
      <div class="ws-card">
        <h3>Rank &amp; Commission</h3>

        <div class="rank-summary">
          <div class="rank-summary-item">
            <div class="rank-summary-label">Total Officers</div>
            <div class="rank-summary-value">{{ number_format($officerReports->count()) }}</div>
          </div>
          <div class="rank-summary-item">
            <div class="rank-summary-label">Total Customers</div>
            <div class="rank-summary-value">{{ number_format($officerReports->sum('customer_count')) }}</div>
          </div>
          <div class="rank-summary-item">
            <div class="rank-summary-label">Total Refer</div>
            <div class="rank-summary-value">{{ number_format($officerReports->sum('refer_count')) }}</div>
          </div>
        </div>

        @php
          $commissionRows = collect([
            ['rank' => '1st ID', 'values' => ['1000', '1000', '1000', '1000'], 'name' => 'Compani'],
            ['rank' => '', 'values' => ['----', '===', '----', '----'], 'name' => 'Amir'],
            ['rank' => '', 'values' => ['-----', '-----', '----', '----'], 'name' => 'Sabir'],
            ['rank' => 'ED', 'values' => ['200', '---', '----', '----'], 'name' => 'Hossain'],
            ['rank' => 'GM', 'values' => ['200', '200', '----', '----'], 'name' => 'Jasim'],
            ['rank' => 'AGM', 'values' => ['200', '200', '200', '----'], 'name' => 'Kasem'],
            ['rank' => 'ME', 'values' => ['300', '200', '200', '200'], 'name' => 'Sadik'],
            ['rank' => 'SO', 'values' => ['500+500', '300', '200', '200'], 'name' => 'Atik'],
            ['rank' => '', 'values' => ['SO', '500+500', '300', '200'], 'name' => 'Nabir'],
            ['rank' => '', 'values' => ['', 'SO', '500+500', '300'], 'name' => 'kabir'],
            ['rank' => '', 'values' => ['', '', 'SO', '500+500'], 'name' => 'jamal'],
            ['rank' => '', 'values' => ['', '', '', 'SO'], 'name' => 'kamal'],
          ]);
        @endphp

        <div class="table-responsive rank-visual">
          <div class="rank-tree">
            @foreach([1, 2, 3, 4, 5, 6] as $level)
              <div class="rank-tree-cell">
                <div class="rank-top-balls">
                  @if($level === 1)
                    <span class="mini-rank-ball"><span>B</span></span>
                    <span class="mini-rank-ball green-text"><span>C</span></span>
                  @elseif($level === 2)
                    <span class="mini-rank-ball"><span>B</span></span>
                    <span class="mini-rank-ball green-text"><span>C</span></span>
                  @elseif($level === 3)
                    <span class="mini-rank-ball"><span>B</span></span>
                    <span class="mini-rank-ball green-text"><span>C</span></span>
                  @elseif($level === 4)
                    <span class="mini-rank-ball"><span>B</span></span>
                    <span class="mini-rank-ball green-text"><span>C</span></span>
                  @elseif($level === 5)
                    <span class="mini-rank-ball"><span>B</span></span>
                    <span class="mini-rank-ball green-text"><span>C</span></span>
                  @else
                    <span class="mini-rank-ball"><span>B</span></span>
                    <span class="mini-rank-ball green-text"><span>C</span></span>
                  @endif
                </div>
                <div class="rank-number">{{ $level }}</div>
                <div class="rank-arrow">&#8595;</div>
                <div class="rank-dot-row">
                  <span class="rank-dot"></span>
                  <span class="rank-dot"></span>
                  <span class="rank-dot"></span>
                  <span class="rank-dot green"></span>
                  <span class="rank-dot green"></span>
                  <span class="rank-dot green"></span>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="rank-title-big">Rank</div>
        <div class="table-responsive">
          <table class="rank-rule-table">
            <tbody>
              <tr>
                <td>নিজের আইডি একটিভ হলে</td>
                <td>1 x - = 0001</td>
                <td><span class="rank-red">SO</span> (Sales Officer)</td>
              </tr>
              <tr>
                <td>নিজের আইডির নিচে ৬টি আইডি একটিভ হলে</td>
                <td>1 x 6 = 0006</td>
                <td><span class="rank-red">ME</span> (Marketing Executive)</td>
              </tr>
              <tr>
                <td>৩টি আইডির নিচে ৩৬টি আইডি একটিভ হলে</td>
                <td>6 x 6 = 0036</td>
                <td><span class="rank-red">AGM</span> (Assistant General Manager)</td>
              </tr>
              <tr>
                <td>৩৬টি আইডির নিচে ২১৬টি আইডি একটিভ হলে</td>
                <td>36 x 6 = 0216</td>
                <td><span class="rank-red">GM</span> (General Manager)</td>
              </tr>
              <tr>
                <td>২১৬টি আইডির নিচে ১২৯৬টি আইডি একটিভ হলে</td>
                <td>216 x 6 = 1296</td>
                <td><span class="rank-red">ED</span> (Executive Director)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="rank-section-heading">Officer</div>
        <div class="commission-note">অফিসারের মাধ্যমে অফিসার যুক্ত হলে রেফার ও জেনারেশন কমিশন নিম্নরূপ</div>
        <div class="table-responsive" style="margin-bottom:16px;">
          <table class="commission-table">
            <thead>
              <tr>
                <th>Rank</th>
                <th>Commission</th>
                <th></th>
                <th></th>
                <th></th>
                <th class="name-col">Offi.Name</th>
              </tr>
            </thead>
            <tbody>
              @foreach($commissionRows as $row)
                <tr>
                  <td><span class="rank-red">{{ $row['rank'] }}</span></td>
                  @foreach($row['values'] as $value)
                    <td><span class="{{ in_array($value, ['SO', '---'], true) ? 'rank-red' : '' }}">{{ $value }}</span></td>
                  @endforeach
                  <td><strong>{{ $row['name'] }}</strong></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <h3>Officer Wise Rank, Refer &amp; Customer</h3>
        <div class="table-responsive">
          <table class="ws-table">
            <thead>
              <tr>
                <th>Rank</th>
                <th>Officer</th>
                <th>Refer</th>
                <th>Customer</th>
              </tr>
            </thead>
            <tbody>
              @forelse($officerReports as $reportOfficer)
                <tr>
                  <td><span class="rank-badge">{{ $reportOfficer->rank_position }}</span></td>
                  <td>
                    <strong>{{ $reportOfficer->name }}</strong><br>
                    <span style="color:#64748b;font-size:12px;">{{ $reportOfficer->email }}</span>
                  </td>
                  <td>{{ number_format($reportOfficer->refer_count) }}</td>
                  <td>{{ number_format($reportOfficer->customer_count) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" style="text-align:center;color:#64748b;">No officer report data found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Workspace: Add Advertise -->
    <div id="ws-add-advertise" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Add Advertise</div>
      <div class="ws-card">
        <h3>Add Advertise</h3>
        @if(isset($appSettings) && ! $appSettings->advertise_enabled)
          <div class="alert alert-warning" style="font-size:13px;">Add Advertise is disabled by Super Admin.</div>
        @endif
        <form class="mock-form">
          <div class="form-grid">
            <div class="form-group">
              <label>Ball</label>
              <input type="text" id="advertiseBall" value="A" readonly>
            </div>
            <div class="form-group">
              <label>Advertise Title *</label>
              <input type="text" required placeholder="Advertise title">
            </div>
            <div class="form-group full-width">
              <label>Advertise Link</label>
              <input type="url" placeholder="https://example.com">
            </div>
            <div class="form-group full-width">
              <label>Advertise Details *</label>
              <textarea required placeholder="Write advertise details" style="height:110px;padding-top:10px;"></textarea>
            </div>
            <div class="form-group">
              <label>Point</label>
              <input type="number" min="0" value="{{ isset($appSettings) ? $appSettings->advertise_default_point : 50 }}">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select>
                @php($defaultAdvertiseStatus = isset($appSettings) ? $appSettings->advertise_default_status : 'active')
                <option value="active" {{ $defaultAdvertiseStatus === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $defaultAdvertiseStatus === 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>
          </div>
          <button type="submit" class="form-submit-btn">Submit Advertise</button>
        </form>
      </div>
    </div>

    <!-- Workspace 7: Packages -->
    <div id="ws-packages" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Packages</div>
      
      <div style="display:grid; grid-template-columns: 1fr; gap: 16px;">
        <div class="ws-card">
          <h3 style="color:var(--red)">Level-1 Packages</h3>
          <div class="table-responsive">
            <table class="ws-table">
              <thead>
                <tr>
                  <th>Item Details</th>
                  <th>Value</th>
                  <th>Booking</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>ক্ল্যাসিক জমি মালিকানা</td>
                  <td>৳ ৭,৪০,০০০ / ৭২ কিস্তি</td>
                  <td>৳ {{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
                  <td><button class="level-chip active mock-purchase-btn" data-pkg="ক্ল্যাসিক জমি মালিকানা">Submit</button></td>
                </tr>
                <tr>
                  <td>১ শতক জমি</td>
                  <td>৳ ২,২০,০০০ / ৭২ কিস্তি</td>
                  <td>৳ {{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
                  <td><button class="level-chip active mock-purchase-btn" data-pkg="১ শতক জমি">Submit</button></td>
                </tr>
                <tr>
                  <td>এক কাঠা প্লট</td>
                  <td>৳ ১৭,০০,০০০ / ১২০ কিস্তি</td>
                  <td>৳ {{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
                  <td><button class="level-chip active mock-purchase-btn" data-pkg="এক কাঠা প্লট">Submit</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="ws-card">
          <h3 style="color:var(--green)">Level-2 Packages</h3>
          <div class="table-responsive">
            <table class="ws-table">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Specifications</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>RO Filter</td>
                  <td>50 GPD Made in China</td>
                  <td>৳ ২১,৫০০/-</td>
                  <td><button class="level-chip active mock-purchase-btn" style="background:var(--green);border-color:var(--green);" data-pkg="RO Filter">Submit</button></td>
                </tr>
                <tr>
                  <td>Macro Oven</td>
                  <td>Standard 20L Oven</td>
                  <td>৳ ১৭,৫০০/-</td>
                  <td><button class="level-chip active mock-purchase-btn" style="background:var(--green);border-color:var(--green);" data-pkg="Macro Oven">Submit</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Workspace 8: Officer Registration Form -->
    <div id="ws-form-officer" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Register Officer</div>
      <div class="ws-card">
        <h3>Officer Registration</h3>
        <form class="mock-form">
          <div class="form-grid">
            <div class="form-group">
              <label>Full Name *</label>
              <input type="text" required placeholder="Officer full name">
            </div>
            <div class="form-group">
              <label>Username *</label>
              <input type="text" required placeholder="Username">
            </div>
            <div class="form-group">
              <label>Email Address *</label>
              <input type="email" required placeholder="officer@mbcbd.com">
            </div>
            <div class="form-group">
              <label>Designation *</label>
              <select required>
                <option value="">Select Designation</option>
                <option value="officer">Officer</option>
                <option value="manager">Branch Manager</option>
              </select>
            </div>
            <div class="form-group">
              <label>Password *</label>
              <input type="password" required placeholder="Min 6 characters">
            </div>
            <div class="form-group">
              <label>Confirm Password *</label>
              <input type="password" required placeholder="Re-type password">
            </div>
          </div>
          <button type="submit" class="form-submit-btn">Submit</button>
        </form>
      </div>
    </div>

    <!-- Workspace 9: Customer Level-1 Booking Form (Inline copy of standard booking form) -->
    <div id="ws-form-customer-l1" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Customer Booking Form (L1)</div>
      
      <div class="ws-card" style="background:#dfeecb; border:8px solid #8fb9e6;">
        <form method="POST" action="{{ route('officer.booking-form.store') }}">
          @csrf
          <div style="text-align:center;font-size:13px;text-decoration:underline wavy #d21f1f;margin-bottom:10px;">বিসমিল্লাহির রাহমানির রাহিম</div>
          <h3 style="text-align:center;color:#8a3bc1;border:0;padding:0;margin:0 0 14px 0;">BOKING FORM</h3>

          @if ($errors->any())
            <div class="alert alert-danger" style="background:#fff0f0; border:1px solid #ffb7b7; color:#7d1010; padding:8px 10px; border-radius:6px; font-size:12px; margin-bottom:12px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

          <div class="form-grid">
            <div class="form-group">
              <label>User Name *</label>
              <input type="text" name="user_name" placeholder="User Name" required>
            </div>
            <div class="form-group">
              <label>Full Name *</label>
              <input type="text" name="full_name" placeholder="Full Name" required>
            </div>
            <div class="form-group">
              <label>Father's / Husband's Name</label>
              <input type="text" name="guardian_name" placeholder="Father's / Husband's Name">
            </div>
            <div class="form-group">
              <label>NID NO</label>
              <input type="text" name="nid_no" placeholder="NID NO">
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input type="text" name="phone_number" placeholder="Phone Number">
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select name="gender">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label>Division *</label>
              <select name="division" id="division" required>
                <option value="">Select Division *</option>
                @foreach(\App\Models\Division::orderBy('name')->get() as $division)
                  <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>District *</label>
              <select name="district" id="district" required>
                <option value="">Select District *</option>
              </select>
            </div>
            <div class="form-group">
              <label>Thana *</label>
              <select name="thana" id="thana" required>
                <option value="">Select Thana *</option>
              </select>
            </div>
            <div class="form-group">
              <label>Union *</label>
              <select name="union" id="union" required>
                <option value="">Select Union *</option>
              </select>
            </div>
            <div class="form-group">
              <label>Holding No and Village</label>
              <input type="text" name="holding_village" placeholder="Holding No and Village">
            </div>
            <div class="form-group">
              <label>Referral ID</label>
              <input type="text" name="referral_id" placeholder="Referral ID">
            </div>
            <div class="form-group">
              <label>Placement User ID</label>
              <input type="text" name="placement_user_id" placeholder="Placement User ID">
            </div>
            <div class="form-group">
              <label>Password *</label>
              <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label>Re-Password *</label>
              <input type="password" name="password_confirmation" placeholder="Re-Password" required>
            </div>
            <div class="form-group">
              <label>Nominee Name</label>
              <input type="text" name="nominee_name" placeholder="Nominee Name">
            </div>
            <div class="form-group">
              <label>Relationship</label>
              <select name="relationship">
                <option value="">Relationship</option>
                <option value="father">Father</option>
                <option value="mother">Mother</option>
                <option value="husband">Husband</option>
                <option value="wife">Wife</option>
                <option value="son">Son</option>
                <option value="daughter">Daughter</option>
                <option value="brother">Brother</option>
                <option value="sister">Sister</option>
              </select>
            </div>
          </div>

          <table class="booking-price-table">
            <tbody>
              <tr>
                <th>Level-1</th>
                <td>অগ্রিম মানি</td>
                <td>বুকিং মানি</td>
                <td>{{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
              </tr>
            </tbody>
          </table>

          <label style="display:flex; align-items:center; gap:8px; margin: 12px 0; font-size:12px; cursor:pointer;">
            <input type="checkbox" name="terms" value="1" required style="width:16px;height:16px;">
            <span>I accept the Terms of Service and Privacy Policy</span>
          </label>

          <button type="submit" class="form-submit-btn" style="background:#cfe4f7; color:#f20d0d; border:1px solid #111; font-weight:800;">Submit Booking</button>
        </form>
      </div>
    </div>

    <!-- Workspace 10: Customer Level-2 Form (Facing, Location, Referrers) -->
    <div id="ws-form-customer-l2" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Customer Form (L2)</div>
      <div class="ws-card">
        <h3 style="color:var(--red);">Customer Registration & Plot Details</h3>
        <form class="mock-form">
          
          <h4 style="color:var(--navy);border-bottom:1px solid #e2e8f0;padding-bottom:4px;margin-bottom:12px;">Customer Personal Form</h4>
          <div class="form-grid">
            <div class="form-group">
              <label>Full Name *</label>
              <input type="text" required placeholder="Full Name">
            </div>
            <div class="form-group">
              <label>Father's Name</label>
              <input type="text" placeholder="Father's Name">
            </div>
            <div class="form-group">
              <label>Mother's Name</label>
              <input type="text" placeholder="Mother's Name">
            </div>
            <div class="form-group">
              <label>Spouse's Name</label>
              <input type="text" placeholder="Spouse's Name">
            </div>
            <div class="form-group full-width">
              <label>Current Address</label>
              <input type="text" placeholder="Current address">
            </div>
            <div class="form-group full-width">
              <label>Permanent Address</label>
              <input type="text" placeholder="Permanent address">
            </div>
            <div class="form-group">
              <label>E-mail Address</label>
              <input type="email" placeholder="email@example.com">
            </div>
            <div class="form-group">
              <label>Phone Number *</label>
              <input type="text" required placeholder="Phone Number">
            </div>
            <div class="form-group">
              <label>NID NO *</label>
              <input type="text" required placeholder="NID Number">
            </div>
            <div class="form-group">
              <label>Date of Birth</label>
              <input type="date">
            </div>
            <div class="form-group">
              <label>Profession</label>
              <input type="text" placeholder="Profession">
            </div>
            <div class="form-group">
              <label>Nominee Name</label>
              <input type="text" placeholder="Nominee Name">
            </div>
          </div>

          <h4 style="color:var(--navy);border-bottom:1px solid #e2e8f0;padding-bottom:4px;margin:20px 0 12px;">Plot Details &amp; Pricing</h4>
          <div class="form-grid">
            <div class="form-group">
              <label>Sector No</label>
              <input type="text" placeholder="Sector No">
            </div>
            <div class="form-group">
              <label>Block No</label>
              <input type="text" placeholder="Block No">
            </div>
            <div class="form-group">
              <label>Road No</label>
              <input type="text" placeholder="Road No">
            </div>
            <div class="form-group">
              <label>Road Width (ft)</label>
              <input type="text" placeholder="Road ft">
            </div>
            <div class="form-group">
              <label>Plot No</label>
              <input type="text" placeholder="Plot No">
            </div>
            <div class="form-group">
              <label>Katha</label>
              <input type="text" placeholder="Katha size">
            </div>
            <div class="form-group">
              <label>Plot Facing</label>
              <select>
                <option value="">Select Facing</option>
                <option value="north">North Facing</option>
                <option value="south">South Facing</option>
                <option value="east">East Facing</option>
                <option value="west">West Facing</option>
              </select>
            </div>
            <div class="form-group">
              <label>Plot Location Type</label>
              <select>
                <option value="">Select Location</option>
                <option value="residential">Residential</option>
                <option value="commercial">Commercial</option>
                <option value="corner">Corner Plot</option>
                <option value="lake">Lake View</option>
              </select>
            </div>
            <div class="form-group">
              <label>Price per Katha</label>
              <input type="number" placeholder="Price/Katha">
            </div>
            <div class="form-group">
              <label>Plot Price</label>
              <input type="number" placeholder="Plot price">
            </div>
            <div class="form-group">
              <label>Total Price</label>
              <input type="number" placeholder="Total Plot Price">
            </div>
            <div class="form-group">
              <label>Service Charge</label>
              <input type="number" placeholder="Service Charge" value="{{ isset($appSettings) ? $appSettings->service_charge : '' }}">
            </div>
            <div class="form-group">
              <label>Booking Money</label>
              <input type="number" placeholder="Booking money paid" value="{{ isset($appSettings) ? $appSettings->booking_money : '' }}">
            </div>
            <div class="form-group">
              <label>Down Payment</label>
              <input type="number" placeholder="Down payment paid">
            </div>
          </div>

          <h4 style="color:var(--navy);border-bottom:1px solid #e2e8f0;padding-bottom:4px;margin:20px 0 12px;">Referrer Information</h4>
          <div class="table-responsive" style="margin-bottom:12px;">
            <table class="ws-table">
              <thead>
                <tr>
                  <th>Referral ID</th>
                  <th>ME</th>
                  <th>AGM</th>
                  <th>GM</th>
                  <th>ED</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" placeholder="Ref ID" style="width:100%; border:0; height:24px;"></td>
                  <td><input type="text" placeholder="ME" style="width:100%; border:0; height:24px;"></td>
                  <td><input type="text" placeholder="AGM" style="width:100%; border:0; height:24px;"></td>
                  <td><input type="text" placeholder="GM" style="width:100%; border:0; height:24px;"></td>
                  <td><input type="text" placeholder="ED" style="width:100%; border:0; height:24px;"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <label style="display:flex; align-items:center; gap:8px; margin: 12px 0; font-size:12px; cursor:pointer;">
            <input type="checkbox" required style="width:16px;height:16px;">
            <span>I accept the Terms of Service and Privacy Policy</span>
          </label>

          <button type="submit" class="form-submit-btn">Submit Customer Form</button>
        </form>
      </div>
    </div>

    <!-- Workspace 11: Agent Registration Form -->
    <div id="ws-form-agent" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Register Agent</div>
      <div class="ws-card">
        <h3>Agent Registration</h3>
        <form class="mock-form">
          <div class="form-grid">
            <div class="form-group">
              <label>Full Name *</label>
              <input type="text" required placeholder="Agent full name">
            </div>
            <div class="form-group">
              <label>Phone Number *</label>
              <input type="text" required placeholder="Phone Number">
            </div>
            <div class="form-group">
              <label>Email Address *</label>
              <input type="email" required placeholder="agent@mbcbd.com">
            </div>
            <div class="form-group">
              <label>Referral ID *</label>
              <input type="text" required placeholder="Referral ID">
            </div>
            <div class="form-group">
              <label>Placement User ID</label>
              <input type="text" placeholder="Placement User ID">
            </div>
            <div class="form-group">
              <label>Password *</label>
              <input type="password" required placeholder="Min 6 characters">
            </div>
            <div class="form-group full-width">
              <label>Home Address</label>
              <textarea placeholder="Full Address" style="height:60px;"></textarea>
            </div>
          </div>
          <button type="submit" class="form-submit-btn">Submit</button>
        </form>
      </div>
    </div>

    <!-- Workspace 12: Merchant Registration Form -->
    <div id="ws-form-merchant" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Register Merchant</div>
      <div class="ws-card">
        <h3>Merchant Registration</h3>
        <form class="mock-form" enctype="multipart/form-data">
          <div class="form-grid">
            <div class="form-group full-width">
              <label>Shop Picture (দোকানের ছবি)</label>
              <input type="file" accept="image/*">
            </div>
            <div class="form-group">
              <label>Shop Name (দোকান/প্রতিষ্ঠানের নাম) *</label>
              <input type="text" required placeholder="Shop Name">
            </div>
            <div class="form-group">
              <label>Business Category *</label>
              <input type="text" required placeholder="e.g. Grocery, Electronics">
            </div>
            <div class="form-group">
              <label>Owner Name *</label>
              <input type="text" required placeholder="Owner Name">
            </div>
            <div class="form-group">
              <label>Phone Number *</label>
              <input type="text" required placeholder="Phone Number">
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" placeholder="merchant@example.com">
            </div>
            <div class="form-group">
              <label>Trade License No</label>
              <input type="text" placeholder="Trade License No">
            </div>
            <div class="form-group full-width">
              <label>Shop Address *</label>
              <textarea required placeholder="Detailed Address" style="height:60px;"></textarea>
            </div>
          </div>
          <button type="submit" class="form-submit-btn">Submit Merchant</button>
        </form>
      </div>
    </div>

    <!-- Workspace 13: Merchant Directory List -->
    <div id="ws-merchant-list" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Merchant Directory</div>
      <div class="ws-card">
        <h3 style="color:var(--red);">Merchant List</h3>
        
        <div class="merchant-filter-row">
          <select id="m-filter-district">
            <option value="">District</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Munshiganj">Munshiganj</option>
          </select>
          <select id="m-filter-thana">
            <option value="">Thana</option>
            <option value="Motijheel">Motijheel</option>
            <option value="Keraniganj">Keraniganj</option>
          </select>
          <select id="m-filter-union">
            <option value="">Union/Council</option>
            <option value="Ward-9">Ward 9</option>
            <option value="Keyain">Keyain</option>
          </select>
          <input type="text" id="m-filter-ward" placeholder="Ward">
          <input type="text" id="m-search" placeholder="Search Merchant...">
        </div>

        <div class="table-responsive">
          <table class="ws-table" id="merchants-directory-table">
            <thead>
              <tr>
                <th style="width: 50px;">NO</th>
                <th>Name</th>
                <th>Address</th>
                <th>Mobil</th>
                <th style="width: 80px; text-align: center;">Sub</th>
              </tr>
            </thead>
            <tbody>
              <tr class="merchant-row" data-name="Father Shop BD-1" data-address="Adamjee Court Annex-2 Motijheel-Dhaka (8th Floor)" data-phone="01935-449752">
                <td>01</td>
                <td class="m-name">Father Shop BD-1</td>
                <td class="m-address">Addomje Cort,Motijeel</td>
                <td class="m-phone">01935449752</td>
                <td style="text-align:center;"><button class="level-chip active btn-merchant-sub" style="margin:0; background:var(--red); border-color:var(--red);">Sub</button></td>
              </tr>
              <tr class="merchant-row" data-name="Father Shop BD-2" data-address="Karim market - Dolaypar" data-phone="01816-178496">
                <td>02</td>
                <td class="m-name">Father Shop BD-2</td>
                <td class="m-address">Karim market -Dolaypar</td>
                <td class="m-phone">01816-178496</td>
                <td style="text-align:center;"><button class="level-chip active btn-merchant-sub" style="margin:0; background:var(--red); border-color:var(--red);">Sub</button></td>
              </tr>
              <tr class="merchant-row" data-name="Modern Hospital" data-address="Signboard, Dhaka" data-phone="01712-345678">
                <td>03</td>
                <td class="m-name">Modern Hospital</td>
                <td class="m-address">Signboard,</td>
                <td class="m-phone">01712345678</td>
                <td style="text-align:center;"><button class="level-chip active btn-merchant-sub" style="margin:0; background:var(--red); border-color:var(--red);">Sub</button></td>
              </tr>
              <tr class="merchant-row" data-name="Shahin Cookeries" data-address="Shani Akhra, Jatrabari, Dhaka" data-phone="01923-456789">
                <td>04</td>
                <td class="m-name">Shahin Cookeries</td>
                <td class="m-address">Shanis Akhra,jatrabari</td>
                <td class="m-phone">01923456789</td>
                <td style="text-align:center;"><button class="level-chip active btn-merchant-sub" style="margin:0; background:var(--red); border-color:var(--red);">Sub</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Workspace 14: Merchant Products Catalog -->
    <div id="ws-merchant-products" class="workspace-section">
      <div class="project-title">
        <span class="marker">O</span> 
        <span id="active-merchant-title">Father Shop BD (1)</span>
      </div>
      
      <div class="ws-card">
        <div style="background:#f1f5f9; border:1px solid #cbd5e1; border-radius:6px; padding:12px; margin-bottom:14px; font-size:14px; font-weight:700; color:var(--navy);">
          <i class="fa fa-map-marker"></i> <span id="active-merchant-desc">Adamjee Court Annex-2 Motijheel-Dhaka (8th Floor) | Phone: 01935-449752</span>
          <button class="btn btn-secondary btn-sm float-right" onclick="$('#btn-menu-merchant-trigger').click();" style="margin-top:-4px;"><i class="fa fa-arrow-left"></i> Back</button>
        </div>

        <h3 style="color:var(--red); margin:0 0 12px 0;">মালামালের তালিকা ও অর্ডার ফর্ম</h3>
        <div class="table-responsive">
          <table class="ws-table" id="catalog-table">
            <thead>
              <tr>
                <th style="width: 50px;">নং</th>
                <th>মালামালের বিবরণ</th>
                <th style="width: 100px;">কেজি / সংখ্যা</th>
                <th style="width: 100px;">মূল্য (৳)</th>
                <th style="width: 120px; text-align: center;">অর্ডার (সংখ্যা)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>০১</td>
                <td>পোলার চাউল (ইতকাল)</td>
                <td>১ কেজি</td>
                <td>১৯০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="পোলার চাউল (ইতকাল)" data-unit="কেজি" data-price="190"></td>
              </tr>
              <tr>
                <td>০২</td>
                <td>পোলার চাউল (চাষী)</td>
                <td>১ কেজি</td>
                <td>১৫০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="পোলার চাউল (চাষী)" data-unit="কেজি" data-price="150"></td>
              </tr>
              <tr>
                <td>০৩</td>
                <td>পোলার চাউল (এসিআই)</td>
                <td>১ কেজি</td>
                <td>১৫৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="পোলার চাউল (এসিআই)" data-unit="কেজি" data-price="155"></td>
              </tr>
              <tr>
                <td>০৪</td>
                <td>পোলার চাউল (প্রাণ)</td>
                <td>১ কেজি</td>
                <td>১৫২</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="পোলার চাউল (প্রাণ)" data-unit="কেজি" data-price="152"></td>
              </tr>
              <tr>
                <td>০৫</td>
                <td>ডালিম (সিলেটী)</td>
                <td>১ কেজি</td>
                <td>১৬২</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="ডালিম (সিলেটী)" data-unit="কেজি" data-price="162"></td>
              </tr>
              <tr>
                <td>০৬</td>
                <td>ডালিম (বরিশাইল)</td>
                <td>১ কেজি</td>
                <td>১৪৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="ডালিম (বরিশাইল)" data-unit="কেজি" data-price="145"></td>
              </tr>
              <tr>
                <td>০৭</td>
                <td>ডালিম (ভারতীয়)</td>
                <td>১ কেজি</td>
                <td>১৩৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="ডালিম (ভারতীয়)" data-unit="কেজি" data-price="135"></td>
              </tr>
              <tr>
                <td>০৮</td>
                <td>ডালিম (কাঁচা)</td>
                <td>১ কেজি</td>
                <td>৮৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="ডালিম (কাঁচা)" data-unit="কেজি" data-price="85"></td>
              </tr>
              <tr>
                <td>০৯</td>
                <td>মসুর ডাল</td>
                <td>১ কেজি</td>
                <td>৬৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="মসুর ডাল" data-unit="কেজি" data-price="65"></td>
              </tr>
              <tr>
                <td>১০</td>
                <td>মটর ডাল (চিকন)</td>
                <td>১ কেজি</td>
                <td>৮৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="মটর ডাল (চিকন)" data-unit="কেজি" data-price="85"></td>
              </tr>
              <tr>
                <td>১১</td>
                <td>মটর ডাল (মোটা)</td>
                <td>১ কেজি</td>
                <td>১১০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="মটর ডাল (মোটা)" data-unit="কেজি" data-price="110"></td>
              </tr>
              <tr>
                <td>১২</td>
                <td>মুগ ডাল</td>
                <td>১ কেজি</td>
                <td>১১০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="মুগ ডাল" data-unit="কেজি" data-price="110"></td>
              </tr>
              <tr>
                <td>১৩</td>
                <td>বুটের ডাল</td>
                <td>১ কেজি</td>
                <td>১৩০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="বুটের ডাল" data-unit="কেজি" data-price="130"></td>
              </tr>
              <tr>
                <td>১৪</td>
                <td>আটা</td>
                <td>১ কেজি</td>
                <td>৯০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="আটা" data-unit="কেজি" data-price="90"></td>
              </tr>
              <tr>
                <td>১৫</td>
                <td>খাসীর খাস (হাফ ডাবল)</td>
                <td>১টি</td>
                <td>৬০৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="খাসীর খাস (হাফ ডাবল)" data-unit="টি" data-price="605"></td>
              </tr>
              <tr>
                <td>১৬</td>
                <td>রানের খাস (হাফ ডাবল)</td>
                <td>১টি</td>
                <td>৮০৫</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="রানের খাস (হাফ ডাবল)" data-unit="টি" data-price="805"></td>
              </tr>
              <tr>
                <td>১৭</td>
                <td>হাঁস লাইভ</td>
                <td>১টি</td>
                <td>৪৫০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="হাঁস লাইভ" data-unit="টি" data-price="450"></td>
              </tr>
              <tr>
                <td>১৮</td>
                <td>ফার্ম মুরগী (এ ফিড)</td>
                <td>১টি</td>
                <td>২৮০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="ফার্ম মুরগী (এ ফিড)" data-unit="টি" data-price="280"></td>
              </tr>
              <tr>
                <td>১৯</td>
                <td>তেলা পিয়া বড় বোরোমা</td>
                <td>১ কেজি</td>
                <td>১৬০</td>
                <td><input type="number" min="0" value="0" class="prod-qty catalog-qty-input" data-name="তেলা পিয়া বড় বোরোমা" data-unit="কেজি" data-price="160"></td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div style="margin-top: 14px; text-align: right;">
          <button class="form-submit-btn" id="btn-generate-memo" style="background:var(--green); border-color:var(--green);"><i class="fa fa-print"></i> Generate Cash Memo</button>
        </div>
      </div>
    </div>

    <!-- Workspace 15: Merchant Cash Memo -->
    <div id="ws-merchant-memo" class="workspace-section">
      <div class="project-title"><span class="marker">O</span> Cash Memo</div>
      
      <div class="ws-card">
        <button class="btn btn-secondary btn-sm mb-3" id="btn-back-to-products"><i class="fa fa-arrow-left"></i> Back to Catalog</button>
        
        <div class="memo-wrapper">
          <div class="memo-header">
            <h2 style="margin:0; color:var(--navy); font-weight:800; font-size:24px;">
              @if(isset($appSettings) && $appSettings->logo)
                <img src="{{ asset($appSettings->logo) }}" alt="Logo" style="max-height: 28px; vertical-align: middle; margin-right: 6px;">
              @endif
              <span id="memo-merchant-name">Father Shop BD (1)</span>
            </h2>
            <div style="font-size:12.5px; color:#555; margin-top:4px;" id="memo-merchant-address">Adamjee Court Annex-2 Motijheel-Dhaka (8th Floor) | Phone: 01935-449752</div>
            <div class="memo-title-badge">ক্যাশ মেমো</div>
          </div>

          <div class="memo-meta-grid">
            <div><span>ইউজার নং:</span> #{{ $officer->id }}</div>
            <div><span>তারিখ:</span> {{ date('d/m/Y') }}</div>
            <div><span>নাম:</span> {{ $officer->name }}</div>
            <div><span>মোবাইল নম্বর:</span> {{ $officer->phone ?? 'N/A' }}</div>
            <div class="full-width" style="grid-column: span 2;"><span>অর্ডার ফোন মোবাইল নম্বর:</span> <span id="memo-merchant-phone">01935-449752</span></div>
          </div>

          <table class="ws-table" style="border: 2px solid #555;" id="memo-invoice-table">
            <thead>
              <tr style="border-bottom: 2px solid #555;">
                <th style="width: 50px; background: #fff; color: #111; border: 1px solid #555;">নং</th>
                <th style="background: #fff; color: #111; border: 1px solid #555;">মালামালের বিবরণ</th>
                <th style="width: 100px; background: #fff; color: #111; border: 1px solid #555; text-align: center;">সংখ্যা</th>
                <th style="width: 100px; background: #fff; color: #111; border: 1px solid #555; text-align: center;">কেজি</th>
                <th style="width: 120px; background: #fff; color: #111; border: 1px solid #555; text-align: right;">মূল্য (৳)</th>
              </tr>
            </thead>
            <tbody>
              <!-- Dynamic rows -->
            </tbody>
            <tfoot>
              <tr class="total-row" style="border-top: 2px solid #555;">
                <td colspan="2" style="border: 1px solid #555;">মোট:</td>
                <td id="memo-total-qty" style="text-align: center; border: 1px solid #555;">০</td>
                <td id="memo-total-weight" style="text-align: center; border: 1px solid #555;">০ কেজি</td>
                <td id="memo-grand-total" style="text-align: right; border: 1px solid #555;">৳ ০/-</td>
              </tr>
              <tr class="total-row">
                <td colspan="4" style="text-align: right; border: 1px solid #555;">সেন্ট:</td>
                <td id="memo-total-cent" style="text-align: right; border: 1px solid #555;">৳ ০/-</td>
              </tr>
            </tfoot>
          </table>

          <div style="display:flex; justify-content:space-between; margin-top:38px; font-size:13.5px; font-weight:700;">
            <div style="border-top: 1px solid #555; padding-top:4px; width:150px; text-align:center;">গ্রাহকের স্বাক্ষর</div>
            <div style="border-top: 1px solid #555; padding-top:4px; width:150px; text-align:center;">পরিশোধ বিবরণী</div>
          </div>
        </div>
        
        <div style="margin-top:14px; text-align:right;">
          <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print Memo</button>
        </div>
      </div>
    </div>

    <footer class="note">Officer panel - role-based dashboard</footer>
  </div>

</div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    function openOfficerWorkspace(workspace) {
        $('.workspace-section').hide().removeClass('active');
        $('#' + workspace).show().addClass('active');
        $('.officer-dashboard-only').addClass('registration-workspace-open');
        $('#registration-category-panel').prop('hidden', true);
    }

    $('.registration-service').on('click', function() {
        $('.officer-dashboard-only').removeClass('registration-workspace-open');
        $('.workspace-section').hide().removeClass('active');
        $('#property-category-panel').prop('hidden', true);
        $('#registration-category-panel').prop('hidden', false);
        $('#officer-label-options, #agent-empty-state').prop('hidden', true);
        $('input[name="registration_category"]').prop('checked', false);
        $('#registration-category-panel')[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    $('.registration-panel-close').on('click', function() {
        $('#registration-category-panel').prop('hidden', true);
    });

    $('.land-project-service').on('click', function() {
        $('.officer-dashboard-only').removeClass('registration-workspace-open');
        $('.workspace-section').hide().removeClass('active');
        $('#registration-category-panel').prop('hidden', true);
        $('#property-category-panel').prop('hidden', false);
        $('#property-category-panel')[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    $('.property-panel-close').on('click', function() {
        $('#property-category-panel').prop('hidden', true);
    });

    $(document).on('change', 'input[name="registration_category"]', function() {
        const category = String($(this).val()).toLowerCase();
        $('#officer-label-options, #agent-empty-state').prop('hidden', true);

        if (category === 'officer') {
            $('#officer-label-options').prop('hidden', false);
        } else if (category === 'customer') {
            window.location.href = '{{ route('officer.booking-form') }}';
        } else if (category === 'merchant') {
            openOfficerWorkspace('ws-form-merchant');
        } else if (category === 'agent') {
            $('#agent-empty-state').prop('hidden', false);
        }
    });

    $('.registration-level').on('click', function() {
        openOfficerWorkspace($(this).data('workspace'));
    });

    $('.letter-button').on('click', function() {
        $('.letter-button').removeClass('active');
        $(this).addClass('active');
    });

    // Dynamic Menu Toggles
    $('.menu-btn, .menu-trigger').on('click', function(e) {
        const href = $(this).attr('href');
        if (href === '#' || !href) {
            e.preventDefault();
        } else {
            return;
        }

        // Handle Active Highlights for Main Menu
        $('.menu-btn').removeClass('active');
        const menuId = $(this).data('menu') || $(this).attr('id');
        if (menuId) {
            if ($(this).hasClass('menu-btn')) {
                $(this).addClass('active');
            } else if (menuId === 'point-store') {
                $('#btn-menu-point-store').addClass('active');
            }
        } else {
            $(this).addClass('active');
        }

        // Toggle Left Sub-Panels
        const targetSub = $(this).data('sub');
        $('.sub-panel-card').hide();
        if (targetSub) {
            $('#' + targetSub).show();
        }

        // Toggle Right Workspace Card
        const targetWs = $(this).data('ws');
        $('.workspace-section').hide().removeClass('active');
        if (targetWs) {
            $('#' + targetWs).show().addClass('active');
        }

        // When switching main menu, trigger the first option in the sub-panel
        if (targetSub) {
            const firstSubLink = $('#' + targetSub).find('.sub-link').first();
            if (firstSubLink.length) {
                // If it is registration, and registration button was clicked, we keep the default L1 registration.
                // Otherwise click the first sub-link.
                if (targetSub === 'sp-registration') {
                    if ($(this).attr('id') === 'btn-menu-merchant-trigger') {
                        $('#sub-link-merchant').click();
                    } else if ($(this).attr('id') === 'btn-menu-agent-trigger') {
                        $('#sub-link-agent').click();
                    } else {
                        $('#sp-registration').find('.sub-link.active').click();
                    }
                } else {
                    firstSubLink.click();
                }
            }
        }
    });

    // Sub-nav-list links click handlers
    $(document).on('click', '.sub-link', function(e) {
        e.preventDefault();

        // Highlight active sub-link
        // Handle normal links vs chips
        if ($(this).hasClass('level-chip')) {
            $('.level-chip').removeClass('active');
            $(this).addClass('active');
            // make parent active in spirit
            $(this).closest('li').siblings().find('.sub-link').removeClass('active');
            $(this).closest('li').find('span').addClass('active');
        } else {
            $('.sub-link').removeClass('active');
            $(this).addClass('active');
        }

        // Toggle Right Workspace Card
        const targetWs = $(this).data('ws');
        $('.workspace-section').hide().removeClass('active');
        if (targetWs) {
            $('#' + targetWs).show().addClass('active');
        }
    });

    $(document).on('click', '.ad-ball-action', function(e) {
        e.preventDefault();

        var ball = $(this).data('ball') || 'A';
        $('#advertiseBall').val(ball);

        $('.menu-btn').removeClass('active');
        $('.workspace-section').hide().removeClass('active');
        $('#ws-add-advertise').show().addClass('active');
    });

    // Handle Mock Form Submissions with success message
    $(document).on('submit', '.mock-form', function(e) {
        e.preventDefault();
        if (typeof toastr !== 'undefined') {
            toastr.success('Registration Form Submitted Successfully (Demo mode)!', '', {"progressbar": true});
        } else {
            alert('Form Submitted Successfully (Demo)!');
        }
        this.reset();
    });

    // Handle mock package submissions
    $(document).on('click', '.mock-purchase-btn', function() {
        const pkgName = $(this).data('pkg');
        if (typeof toastr !== 'undefined') {
            toastr.success('Successfully Selected Package: ' + pkgName, '', {"progressbar": true});
        } else {
            alert('Selected Package: ' + pkgName);
        }
    });

    // Customer Level-1 Geographic Dropdowns AJAX logic
    $('#division').on('change', function() {
        var divisionId = $(this).val();
        $('#district').html('<option value="">Select District *</option>');
        $('#thana').html('<option value="">Select Thana *</option>');
        $('#union').html('<option value="">Select Union *</option>');
        
        if (divisionId) {
            $.ajax({
                url: '{{ url("/get-districts") }}/' + divisionId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    $('#district').on('change', function() {
        var districtId = $(this).val();
        $('#thana').html('<option value="">Select Thana *</option>');
        $('#union').html('<option value="">Select Union *</option>');
        
        if (districtId) {
            $.ajax({
                url: '{{ url("/get-upazilas") }}/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#thana').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    $('#thana').on('change', function() {
        var upazilaId = $(this).val();
        $('#union').html('<option value="">Select Union *</option>');
        
        if (upazilaId) {
            $.ajax({
                url: '{{ url("/get-unions") }}/' + upazilaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#union').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    // Active Merchant metadata
    var selectedMerchantName = '';
    var selectedMerchantAddress = '';
    var selectedMerchantPhone = '';

    // Click "Sub" button in Merchant List
    $(document).on('click', '.btn-merchant-sub', function() {
        var row = $(this).closest('.merchant-row');
        selectedMerchantName = row.data('name');
        selectedMerchantAddress = row.data('address');
        selectedMerchantPhone = row.data('phone');

        // Update active merchant values in catalog and cash memo views
        $('#active-merchant-title').text(selectedMerchantName);
        $('#active-merchant-desc').text(selectedMerchantAddress + ' | Phone: ' + selectedMerchantPhone);
        
        $('#memo-merchant-name').text(selectedMerchantName);
        $('#memo-merchant-address').text(selectedMerchantAddress + ' | Phone: ' + selectedMerchantPhone);
        $('#memo-merchant-phone').text(selectedMerchantPhone);

        // Reset all inputs in product catalog
        $('.prod-qty').val(0);

        // Display catalog workspace
        $('.workspace-section').hide().removeClass('active');
        $('#ws-merchant-products').show().addClass('active');
    });

    // Generate Cash Memo button click
    $('#btn-generate-memo').on('click', function() {
        var invoiceBody = $('#memo-invoice-table tbody');
        invoiceBody.empty();

        var totalQty = 0;
        var totalWeight = 0;
        var grandTotal = 0;
        var count = 1;

        $('.prod-qty').each(function() {
            var qty = parseInt($(this).val());
            if (qty > 0) {
                var name = $(this).data('name');
                var unit = $(this).data('unit');
                var price = parseFloat($(this).data('price'));
                var lineTotal = price * qty;
                grandTotal += lineTotal;

                var displayQty = '-';
                var displayWeight = '-';

                if (unit === 'টি') {
                    displayQty = qty + 'টি';
                    totalQty += qty;
                } else if (unit === 'কেজি') {
                    displayWeight = qty + ' কেজি';
                    totalWeight += qty;
                }

                var rowHtml = '<tr>' +
                    '<td style="border: 1px solid #555;">' + (count < 10 ? '০' + count : count) + '</td>' +
                    '<td style="border: 1px solid #555;">' + name + '</td>' +
                    '<td style="text-align: center; border: 1px solid #555;">' + displayQty + '</td>' +
                    '<td style="text-align: center; border: 1px solid #555;">' + displayWeight + '</td>' +
                    '<td style="text-align: right; border: 1px solid #555;">' + lineTotal + '/-</td>' +
                    '</tr>';

                invoiceBody.append(rowHtml);
                count++;
            }
        });

        if (count === 1) {
            toastr.warning('দয়া করে অন্তত একটি প্রোডাক্ট সিলেক্ট করুন!', '', {"progressbar": true});
            return;
        }

        // Update totals
        $('#memo-total-qty').text(totalQty + 'টি');
        $('#memo-total-weight').text(totalWeight + ' কেজি');
        $('#memo-grand-total').text('৳ ' + grandTotal + '/-');
        $('#memo-total-cent').text('৳ ' + grandTotal + '/-');

        // Go to cash memo workspace
        $('.workspace-section').hide().removeClass('active');
        $('#ws-merchant-memo').show().addClass('active');
    });

    // Back to Catalog click
    $('#btn-back-to-products').on('click', function() {
        $('.workspace-section').hide().removeClass('active');
        $('#ws-merchant-products').show().addClass('active');
    });

    // Merchant list filters & search
    $('#m-search').on('keyup', function() {
        var query = $(this).val().toLowerCase();
        filterMerchants();
    });

    $('#m-filter-district, #m-filter-thana, #m-filter-union, #m-filter-ward').on('change keyup', function() {
        filterMerchants();
    });

    function filterMerchants() {
        var searchVal = $('#m-search').val().toLowerCase();
        var districtVal = $('#m-filter-district').val().toLowerCase();
        var thanaVal = $('#m-filter-thana').val().toLowerCase();
        var unionVal = $('#m-filter-union').val().toLowerCase();
        var wardVal = $('#m-filter-ward').val().toLowerCase();

        $('.merchant-row').each(function() {
            var name = $(this).data('name').toLowerCase();
            var address = $(this).data('address').toLowerCase();
            var phone = $(this).data('phone').toLowerCase();

            var matchesSearch = !searchVal || name.indexOf(searchVal) > -1 || address.indexOf(searchVal) > -1 || phone.indexOf(searchVal) > -1;
            var matchesDistrict = !districtVal || address.indexOf(districtVal) > -1;
            var matchesThana = !thanaVal || address.indexOf(thanaVal) > -1;
            var matchesUnion = !unionVal || address.indexOf(unionVal) > -1;
            var matchesWard = !wardVal || address.indexOf(wardVal) > -1;

            if (matchesSearch && matchesDistrict && matchesThana && matchesUnion && matchesWard) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});
</script>
@endpush
