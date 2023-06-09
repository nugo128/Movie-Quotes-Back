<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
	use HasFactory;

	protected $fillable = [
		'quote',
		'thumbnail',
	];

	public function movie(): BelongsTo
	{
		return $this->belongsTo(Movie::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function like(): HasMany
	{
		return $this->hasMany(Like::class);
	}

	public function comment(): HasMany
	{
		return $this->hasMany(Comment::class);
	}
}
