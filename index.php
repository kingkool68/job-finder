<?php
$job_boards = array(
    'jobs.lever.co',
    'boards.greenhouse.io',
    'jobs.ashbyhq.com',
    'jobs.jobvite.com',
    'jobs.smartrecruiters.com',
    'jobs.workable.com',
    'myworkdayjobs.com',
    'careers.jobscore.com',
    'ats.comparably.com',
);

$timeframes = array(
    'day'   => 'Day',
    'week'  => 'Week',
    'month' => 'Month',
    'year'  => 'Year',
);

function get_timeframe() {
    global $timeframes;
    $timeframe = 'week';
    if ( ! empty( $_GET['past'] ) && ! empty( $timeframes[ $_GET['past'] ] ) ) {
        $timeframe = $_GET['past'];
    }
    return $timeframe;
}

function get_term() {
     $term = '';
    if ( ! empty( $_GET['s'] ) ) {
        $term = $_GET['s'];
    }
    return $term;
}

function get_link( $job_board = '' ) {
    $google_timeframe = '';
    $timeframe_key = get_timeframe();
    $google_timeframes = array(
        'day'   => 'qdr:d',
        'week'  => 'qdr:w',
        'month' => 'qdr:m',
        'year'  => 'qdr:y'
    );
    if ( ! empty( $google_timeframes[ $timeframe_key ] ) ) {
        $google_timeframe = $google_timeframes[ $timeframe_key ];
    }

    $query = array(
        'q'   => 'site:' . $job_board . ' ' . get_term(),
        'tbs' => $google_timeframe,
    );
    if ( empty( $query['tbs'] ) ) {
        unset( $query['tbs'] );
    }
    return 'https://www.google.com/search?' . http_build_query( $query );
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Use Google to Find Job Postings</title>
    <link rel="stylesheet" href="style.css?r=<?php echo filemtime('style.css'); ?>">
  </head>
  <body>
    <form method="GET" id="the-form">
        <p>Find a job about
            <label for="job-keyword" class="screen-reader-text">Job Keyword</label>
            <input type="text" name="s" value="<?php echo htmlspecialchars( get_term() ); ?>" id="job-keyword" class="text-input" placeholder="keyword" required>
            posted within the past
            <label for="timeframe" class="screen-reader-text">Time frame</label>
            <select name="past" id="timeframe" class="select-input">
                <?php foreach( $timeframes as $key => $time ) : ?>
                    <option value="<?php echo $key; ?>" <?php if ( $key === get_timeframe() ) : ?>selected<?php endif; ?>><?php echo $time ?></option>
                <?php endforeach; ?>
            </select>

            <input type="Submit" id="the-submit-button" class="submit-button" value="Go">
        </p>
    </form>
    <?php if ( ! empty( get_term() ) ) : ?>
        <?php foreach( $job_boards as $item ) : ?>
            <p>
                <a href="<?php echo get_link( $item ); ?>" target="_blank">
                    <?php echo $item; ?>
                </a>
            </p>
        <?php endforeach; ?>
    <?php endif;  ?>
    <footer>
        <p class="credit">Made by <a href="https://www.linkedin.com/in/kingkool68/" target="_blank">@kingkool68</a><br>(who is looking for a job)</p>
    </footer>
    <script src="script.js?r=<?php echo filemtime('script.js'); ?>"></script>
  </body>
</html>
