<?php $__env->startSection('title', 'DEV — Modern Engineering & Design'); ?>

<?php $__env->startSection('content'); ?>

  <!-- 1. HERO FEATURED ARTICLE -->
  <?php if($heroArticle): ?>
  <section style="background-color: var(--surface); color: var(--text); padding: 4rem 0 4.5rem; border-bottom: 1px solid var(--border);">
    <div class="container">
      <div style="display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 3.5rem; align-items: center;" class="hero-grid-smashing">
        <div>
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
            <a href="<?php echo e(route('category.show', $heroArticle->category->slug)); ?>" 
               style="background-color: var(--chip-bg); color: var(--chip-text); font-size: 13px; font-weight: 700; text-transform: uppercase; padding: 0.35rem 0.85rem; border-radius: 9999px; letter-spacing: 0.05em; text-decoration: none;">
              <?php echo e($heroArticle->category->name); ?>

            </a>
            <span class="label-mono" style="color: var(--primary);">
              <?php echo e($heroArticle->kicker ?? 'Featured Story'); ?>

            </span>
          </div>

          <h1 style="font-size: clamp(2.3rem, 4.5vw, 3.4rem); font-weight: 800; line-height: 1.15; margin-bottom: 1.25rem; letter-spacing: -0.02em;">
            <a href="<?php echo e(route('articles.show', $heroArticle->slug)); ?>" style="color: var(--heading); text-decoration: none;">
              <?php echo e($heroArticle->title); ?>

            </a>
          </h1>

          <p style="font-size: 1.15rem; line-height: 1.65; color: var(--muted); margin-bottom: 2rem; max-width: 620px;">
            <?php echo e($heroArticle->excerpt); ?>

          </p>

          <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
            <img src="<?php echo e($heroArticle->author->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80'); ?>" alt="<?php echo e($heroArticle->author->name); ?>" style="width: 46px; height: 46px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
            <div>
              <div style="font-weight: 700; font-size: 15px; color: var(--heading);"><?php echo e($heroArticle->author->name); ?></div>
              <div style="font-size: 13.5px; color: var(--muted);">
                <?php echo e($heroArticle->published_at ? $heroArticle->published_at->format('M d, Y') : 'Recent'); ?> • <?php echo e($heroArticle->reading_time); ?> • <?php echo e($heroArticle->views_count); ?> reads
              </div>
            </div>
          </div>

          <div>
            <a href="<?php echo e(route('articles.show', $heroArticle->slug)); ?>" class="btn-smash">
              <span>Read Full Article</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>

        <div>
          <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); border: 1px solid var(--border);">
            <a href="<?php echo e(route('articles.show', $heroArticle->slug)); ?>">
              <img src="<?php echo e($heroArticle->cover_image_url); ?>" alt="<?php echo e($heroArticle->title); ?>" style="width: 100%; height: 380px; object-fit: cover; display: block; transition: transform 300ms ease;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            </a>
            <?php if($heroArticle->cover_caption): ?>
              <div style="padding: 0.65rem 1rem; font-size: 13px; color: var(--muted); background-color: var(--surface); border-top: 1px solid var(--border);">
                <?php echo e($heroArticle->cover_caption); ?>

              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 2. FEATURED ARTICLES ROW -->
  <section style="padding: 4.5rem 0; border-bottom: 1px solid var(--border);">
    <div class="container">
      <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 2rem; border-bottom: 2px solid var(--border); padding-bottom: 0.75rem;">
        <div>
          <h2 style="font-size: 1.875rem; font-weight: 800; letter-spacing: -0.02em; color: var(--heading);">Featured In Front-End & Design</h2>
        </div>
        <a href="<?php echo e(route('pages.guides')); ?>" style="font-weight: 700; font-size: 14.5px; color: var(--primary); display: inline-flex; align-items: center; gap: 0.35rem;">
          <span>Explore All Guides</span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>

      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;" class="grid-cards-smashing">
        <?php $__currentLoopData = $featuredArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <article class="article-card-smashing" style="border-top-color: <?php echo e($article->category->accent_color); ?>;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem 0.5rem;">
              <a href="<?php echo e(route('category.show', $article->category->slug)); ?>" style="display: inline-flex; align-items: center; gap: 0.35rem; text-decoration: none;">
                <span style="width: 7px; height: 7px; border-radius: 50%; background-color: <?php echo e($article->category->accent_color); ?>; display: inline-block;"></span>
                <span class="label-mono" style="color: var(--primary);"><?php echo e($article->category->name); ?></span>
              </a>
              <span style="font-size: 13px; color: var(--muted); display: inline-flex; align-items: center; gap: 0.3rem;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <span><?php echo e($article->comments->count()); ?></span>
              </span>
            </div>

            <?php if($article->cover_image): ?>
              <a href="<?php echo e(route('articles.show', $article->slug)); ?>" style="display: block; margin: 0 1.5rem 0.5rem; border-radius: 8px; overflow: hidden;">
                <img src="<?php echo e($article->cover_image_url); ?>" alt="<?php echo e($article->title); ?>" style="width: 100%; height: 160px; object-fit: cover; transition: transform 250ms ease;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
              </a>
            <?php endif; ?>

            <div style="padding: 0.5rem 1.5rem 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
              <h3 style="font-size: 1.35rem; font-weight: 700; line-height: 1.3; margin-bottom: 0.75rem;">
                <a href="<?php echo e(route('articles.show', $article->slug)); ?>" style="color: var(--heading); text-decoration: none;"><?php echo e($article->title); ?></a>
              </h3>
              <p style="font-size: 15px; color: var(--text); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?php echo e($article->excerpt); ?></p>
              
              <div style="display: flex; align-items: center; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                <img src="<?php echo e($article->author->avatar); ?>" alt="<?php echo e($article->author->name); ?>" style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                <div>
                  <div style="font-size: 13.5px; font-weight: 700; color: var(--heading);"><?php echo e($article->author->name); ?></div>
                  <div class="label-mono" style="font-size: 12px; color: var(--muted);"><?php echo e($article->published_at ? $article->published_at->format('M d, Y') : 'Recent'); ?> • <?php echo e($article->reading_time); ?></div>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>

  <!-- 3. GUIDES MODULE -->
  <?php if($guides->count() > 0): ?>
  <section style="background-color: var(--surface-2); padding: 4.5rem 0; border-bottom: 1px solid var(--border);">
    <div class="container">
      <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 2.25rem;">
        <div>
          <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.25rem;">Curated Reference Materials</span>
          <h2 style="font-size: 1.875rem; font-weight: 800; letter-spacing: -0.02em; color: var(--heading);">Engineering Guides & Field Handbooks</h2>
        </div>
        <a href="<?php echo e(route('pages.guides')); ?>" style="font-weight: 700; font-size: 14.5px; color: var(--primary);">View All Guides →</a>
      </div>

      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;" class="guides-grid">
        <?php $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div style="background-color: var(--surface); border-radius: 12px; border: 1px solid var(--border); padding: 1.5rem; display: flex; flex-direction: column; transition: transform 150ms ease;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
            <span style="display: inline-flex; align-items: center; gap: 0.35rem; margin-bottom: 0.5rem;">
              <span style="width: 7px; height: 7px; border-radius: 50%; background-color: <?php echo e($guide->category->accent_color); ?>; display: inline-block;"></span>
              <span class="label-mono" style="color: var(--primary);"><?php echo e($guide->category->name); ?> Guide</span>
            </span>
            <h4 style="font-size: 1.15rem; font-weight: 700; line-height: 1.35; margin-bottom: 0.75rem; flex-grow: 1;">
              <a href="<?php echo e(route('articles.show', $guide->slug)); ?>" style="color: var(--heading); text-decoration: none;"><?php echo e($guide->title); ?></a>
            </h4>
            <div style="font-size: 13px; color: var(--muted); display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--border); padding-top: 0.75rem;">
              <span>By <?php echo e($guide->author->name); ?></span>
              <span><?php echo e($guide->reading_time); ?></span>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 4. LATEST ARTICLES GRID -->
  <section style="padding: 4.5rem 0; border-bottom: 1px solid var(--border);">
    <div class="container">
      <div style="margin-bottom: 2.5rem; border-bottom: 2px solid var(--border); padding-bottom: 0.75rem;">
        <h2 style="font-size: 1.875rem; font-weight: 800; letter-spacing: -0.02em; color: var(--heading);">Latest Published Articles</h2>
      </div>

      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;" class="grid-cards-smashing">
        <?php $__currentLoopData = $latestArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <article class="article-card-smashing" style="border-top-color: <?php echo e($article->category->accent_color); ?>;">
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem 0.5rem;">
              <a href="<?php echo e(route('category.show', $article->category->slug)); ?>" style="display: inline-flex; align-items: center; gap: 0.35rem; text-decoration: none;">
                <span style="width: 7px; height: 7px; border-radius: 50%; background-color: <?php echo e($article->category->accent_color); ?>; display: inline-block;"></span>
                <span class="label-mono" style="color: var(--primary);"><?php echo e($article->category->name); ?></span>
              </a>
              <span style="font-size: 13px; color: var(--muted); display: inline-flex; align-items: center; gap: 0.3rem;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <span><?php echo e($article->comments->count()); ?></span>
              </span>
            </div>

            <?php if($article->cover_image): ?>
              <a href="<?php echo e(route('articles.show', $article->slug)); ?>" style="display: block; margin: 0 1.5rem 0.5rem; border-radius: 8px; overflow: hidden;">
                <img src="<?php echo e($article->cover_image_url); ?>" alt="<?php echo e($article->title); ?>" style="width: 100%; height: 160px; object-fit: cover; transition: transform 250ms ease;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
              </a>
            <?php endif; ?>

            <div style="padding: 0.5rem 1.5rem 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
              <h3 style="font-size: 1.35rem; font-weight: 700; line-height: 1.3; margin-bottom: 0.75rem;">
                <a href="<?php echo e(route('articles.show', $article->slug)); ?>" style="color: var(--heading); text-decoration: none;"><?php echo e($article->title); ?></a>
              </h3>
              <p style="font-size: 15px; color: var(--text); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?php echo e($article->excerpt); ?></p>
              
              <div style="display: flex; align-items: center; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                <img src="<?php echo e($article->author->avatar); ?>" alt="<?php echo e($article->author->name); ?>" style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border);">
                <div>
                  <div style="font-size: 13.5px; font-weight: 700; color: var(--heading);"><?php echo e($article->author->name); ?></div>
                  <div class="label-mono" style="font-size: 12px; color: var(--muted);"><?php echo e($article->published_at ? $article->published_at->format('M d, Y') : 'Recent'); ?> • <?php echo e($article->reading_time); ?></div>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <!-- Pagination Links -->
      <div style="margin-top: 3.5rem; display: flex; justify-content: center;">
        <?php echo e($latestArticles->links()); ?>

      </div>
    </div>
  </section>

  <!-- 5. BOOKS & WORKSHOPS -->
  <section style="background-color: var(--surface); padding: 4.5rem 0; border-bottom: 1px solid var(--border);">
    <div class="container">
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem;" class="books-workshops-grid">
        
        <!-- Column 1: Books -->
        <div>
          <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 1.5rem; border-bottom: 2px solid var(--border); padding-bottom: 0.5rem;">
            <h3 style="font-size: 1.45rem; font-weight: 800; color: var(--heading);">Printed & Digital Books</h3>
            <a href="<?php echo e(route('pages.books')); ?>" style="font-size: 14px; font-weight: 700; color: var(--primary);">All Books →</a>
          </div>

          <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div style="display: flex; gap: 1.25rem; padding: 1.25rem; background-color: var(--surface-2); border-radius: 12px; border: 1px solid var(--border); align-items: center;">
                <img src="<?php echo e($book->cover_image); ?>" alt="<?php echo e($book->title); ?>" style="width: 80px; height: 110px; object-fit: cover; border-radius: 6px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); flex-shrink: 0;">
                <div>
                  <h4 style="font-size: 1.1rem; font-weight: 700; color: var(--heading); margin-bottom: 0.25rem;"><?php echo e($book->title); ?></h4>
                  <p style="font-size: 13.5px; color: var(--muted); margin-bottom: 0.5rem;">By <?php echo e($book->author); ?> • <strong style="color: var(--primary);"><?php echo e($book->price); ?></strong></p>
                  <p style="font-size: 14px; color: var(--text); line-height: 1.45;"><?php echo e($book->description); ?></p>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

        <!-- Column 2: Workshops -->
        <div>
          <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 1.5rem; border-bottom: 2px solid var(--border); padding-bottom: 0.5rem;">
            <h3 style="font-size: 1.45rem; font-weight: 800; color: var(--heading);">Online Masterclasses</h3>
            <a href="<?php echo e(route('pages.workshops')); ?>" style="font-size: 14px; font-weight: 700; color: var(--primary);">All Workshops →</a>
          </div>

          <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            <?php $__currentLoopData = $workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workshop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div style="padding: 1.5rem; background-color: var(--surface-2); border-radius: 12px; border: 1px solid var(--border); border-left: 5px solid var(--primary);">
                <span class="label-mono" style="color: var(--primary); display: block; margin-bottom: 0.35rem;">
                  <?php echo e($workshop->date_str); ?>

                </span>
                <h4 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--heading);">
                  <?php echo e($workshop->title); ?>

                </h4>
                <p style="font-size: 14px; color: var(--text); margin-bottom: 1rem; line-height: 1.5;">
                  <?php echo e($workshop->description); ?>

                </p>
                <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--border); padding-top: 0.75rem;">
                  <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <img src="<?php echo e($workshop->instructor_avatar); ?>" alt="<?php echo e($workshop->instructor); ?>" style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                    <span style="font-size: 13.5px; font-weight: 700; color: var(--heading);"><?php echo e($workshop->instructor); ?></span>
                  </div>
                  <span style="font-size: 15px; font-weight: 800; color: var(--primary);"><?php echo e($workshop->price); ?></span>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

      </div>
    </div>
  </section>

  <style>
    @media (max-width: 992px) {
      .hero-grid-smashing {
        grid-template-columns: 1fr !important;
      }
      .grid-cards-smashing {
        grid-template-columns: 1fr 1fr !important;
      }
      .guides-grid {
        grid-template-columns: 1fr 1fr !important;
      }
      .books-workshops-grid {
        grid-template-columns: 1fr !important;
      }
    }

    @media (max-width: 640px) {
      .grid-cards-smashing, .guides-grid {
        grid-template-columns: 1fr !important;
      }
    }
  </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\web development\codemir blog site\smashing-blog\resources\views/home.blade.php ENDPATH**/ ?>