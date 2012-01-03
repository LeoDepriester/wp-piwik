<?php
/*********************************
	WP-Piwik::Stats:Pages
**********************************/

	$aryConf['data'] = $this->callPiwikAPI(
			'Actions.getPageTitles', 
			$aryConf['params']['period'], 
			$aryConf['params']['date'],
			$aryConf['params']['limit']
	);
	$intMax = 9;
	$aryConf['title'] = __('Pages', 'wp-piwik');
/***************************************************************************/ ?>
<div class="table">
	<table class="widefat wp-piwik-table">
		<thead>
			<tr>
				<th><?php _e('Page', 'wp-piwik'); ?></th>
				<th class="n"><?php _e('Unique', 'wp-piwik'); ?></th>
				<th class="n"><?php _e('Visits', 'wp-piwik'); ?></th>
			</tr>
		</thead>
		<tbody>
<?php /************************************************************************/
	$intCount = 0; $aryOthers = array('u' => 0, 'v' => 0);
	if (is_array($aryConf['data'])) foreach ($aryConf['data'] as $aryValues) {
		$intCount++;
		if ($intCount > $intMax) {
			$aryOthers['u'] += $aryValues['nb_uniq_visitors'];
			$aryOthers['v'] += $aryValues['nb_visits'];
		} else echo '<tr><td>'.
				$aryValues['label'].
			'</td><td class="n">'.
				$aryValues['nb_uniq_visitors'].
			'</td><td class="n">'.
				$aryValues['nb_visits'].
			'</td></tr>';
	} else echo '<tr><td colspan="3">'.__('No data available.', 'wp-piwik').'</td></tr>';
	if (!empty($aryOthers['v'])) echo '<tr><td>'.
                                __('Others', 'wp-piwik').
                        '</td><td class="n">'.
                                $aryOthers['u'].
                        '</td><td class="n">'.
                                $aryOthers['v'].
                        '</td></tr>';

/***************************************************************************/ ?>
		</tbody>
	</table>
</div>