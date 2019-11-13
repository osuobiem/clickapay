<aside class="sidebar" data-trigger="scrollbar" style="margin-top: -30px;">
      <div class="sidebar--nav">
        <ul>
          <li>
            <ul>
              <li id="dashboard"> <a href="<?=base_url()?>1dama3na"> <i class="fa fa-home"></i> <span>Dashboard</span> </a> </li>
              <li id="users"> <a href="<?=base_url()?>1dama3na/users"> <i class="fa fa-users"></i> <span>Users</span> </a></li>
              <li id="providers"> <a href="<?=base_url()?>1dama3na/providers"> <i class="fa fa-user-tie"></i> <span>Providers</span> </a></li>
              <li id="ads"> <a href="<?=base_url()?>1dama3na/ads"> <i class="fa fa-audio-description"></i> <span>Ads</span> </a></li>
              <li id="faqs"> <a href="<?=base_url()?>1dama3na/faqs"> <i class="fa fa-question-circle"></i> <span>FAQs</span> </a></li>
            </ul>
          </li>
        </ul>
      </div>
    </aside>
    <script>
      let link = document.getElementById('<?=$active_link?>');

      link.setAttribute('class', 'active');
    </script>
    <main class="main--container">