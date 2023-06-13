<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
	use HasFactory;
	protected $fillable = [
		'quote_id',
		'user_id',
		'created_at',
		'comments'
	];

	public function quote(): BelongsTo
	{
		return $this->belongsTo(Quote::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
